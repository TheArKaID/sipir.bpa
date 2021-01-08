<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\Helpers\Reportable;
use App\History;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

/**
 * Implementing Polymorphism with Reportable
 */
class DashboardController extends Controller implements Reportable
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        // @php
        $vehicles = 0;
        $histories = 0;
        $mahasiswa = 0;
        $parked = 0;
        
        $allmahasiswa = $this->getMahasiswa();
        foreach ($allmahasiswa as $m) {
            $mahasiswa++;
            foreach ($m->kendaraans as $k) {
                $parkedCount = 0;
                $vehicles++;
                foreach ($k->histories as $h) {
                    $histories++;
                }
                $isParked = $k->getIsParked();
                if($isParked && $parkedCount==0){
                    $parked++;
                    $parkedCount++;
                }
            }
        }
        return view('admin.dashboard', [
            'mahasiswa'=>$mahasiswa,
            'vehicles'=>$vehicles,
            'histories'=>$histories,
            'parked'=>$parked
        ]);
    }

    /**
     * Mengambil data semua mahasiswa
     * 
     * @return \Illuminate\Database\Eloquent\Collection|[]
     */
    public function getMahasiswa()
    {
        return Mahasiswa::all();
    }

    /**
     * The Printer
     */
    public function print($week = false)
    {
        if($week) {
            $start = Carbon::now()->subDays(7);
            $end = Carbon::now();
            // dd($start);
            $catatan = History::whereBetween('waktu', [$start, $end])->get();
        } else {
            $catatan = History::all();
        }
        return $catatan;
    }
    
    /**
     * Print data last 7 days
     */
    public function printWeek()
    {
        $catatan = $this->print(true);
        $histories = $this->pairingInOut($catatan);

        return $this->spreadSheetMaker($histories);
    }

    /**
     * Print data all the day
     */
    public function printAll()
    {
        $catatan = $this->print();
        $histories = $this->pairingInOut($catatan);

        return $this->spreadSheetMaker($histories);
    }

    /**
     * Data Pairing Here
     */
    public function pairingInOut($histories)
    {
        // Data Pairing semuanya
        $InOutPaired = [];
        // Foreach data Histories
        foreach ($histories as $history) {
            // Kalau baru pertama
            if(!$InOutPaired) {
                $thisVehicle = [];
                if($history->tipe==0) {
                    array_push($thisVehicle, 'skip');
                }
                array_push($thisVehicle, $history);
                array_push($InOutPaired, $thisVehicle);
            } else {
                $lengthAll = count($InOutPaired);
                $isPairing = true;
                // Foreach data yang sudah masuk
                foreach ($InOutPaired as $row => $paired) {
                    // dd(count($paired)!=2 && ($paired[0]!=0 ? $paired[0]->kendaraan_id==$history->kendaraan_id : false));
                    // kalau datanya sama dengan data history sekarang, dan belu paired, maka pairing
                    
                    if(count($paired)!=2 && ($paired[0]!='skip' ? $paired[0]->kendaraan_id==$history->kendaraan_id : false)){
                        array_push($paired, $history);
                        $InOutPaired[$row] = $paired;
                        $isPairing = false;
                    }
                    // Kalau perulangannya selesai, dan belum paired, tambah data baru
                    if($lengthAll==($row+1) && $isPairing){
                        $thisVehicle = [$history];
                        array_push($InOutPaired, $thisVehicle);
                    }
                }
            }
        }
        return $InOutPaired;
    }

    /**
     * Excelable Here
     */
    public function spreadSheetMaker($histories)
    {
        $spreadsheet = new Spreadsheet;
        
        // Setting awal file excel
        $spreadsheet->getProperties()->setCreator('20170140037')
                               ->setLastModifiedBy('20170140037')
                               ->setTitle('SI Pencatatan Parkir - Weekly ')
                               ->setSubject('SI Pencatatan Parkir - Weekly ')
                               ->setDescription('SI Pencatatan Parkir - Weekly ')
                               ->setKeywords('SI Pencatatan Parkir - Weekly ');
        // Buat sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Styling headernya
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Styling isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Set Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Pemilik');
        $sheet->setCellValue('C1', 'No. Polisi');
        $sheet->setCellValue('D1', 'Masuk');
        $sheet->setCellValue('E1', 'Keluar');
        $sheet->setCellValue('F1', 'Waktu Parkir');

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A1')->applyFromArray($style_col);
        $sheet->getStyle('B1')->applyFromArray($style_col);
        $sheet->getStyle('C1')->applyFromArray($style_col);
        $sheet->getStyle('D1')->applyFromArray($style_col);
        $sheet->getStyle('E1')->applyFromArray($style_col);
        $sheet->getStyle('F1')->applyFromArray($style_col);

        // Isi data ke excel
        // Ini posisi data dimulai dari row 2
        $pos = 2;
        foreach ($histories as $key => $history) {
            $row = $history[0]!='skip' ? 0 : 1;
            $sheet->setCellValue('A'.$pos, $key+1);
            $sheet->setCellValue('B'.$pos, $history[$row]->kendaraan->mahasiswa->nama);
            $sheet->setCellValue('C'.$pos, $history[$row]->kendaraan->nomor);
            $sheet->setCellValue('D'.$pos, $history[0]!='skip' ? $history[0]->waktu : '-');
            $sheet->setCellValue('E'.$pos, array_key_exists(1, $history) ? $history[1]->waktu : '-');
            
            $in = Carbon::createFromTimeString($history[0]!='skip' ? $history[0]->waktu : Carbon::now());
            $out = Carbon::createFromTimeString(array_key_exists(1, $history) ? $history[1]->waktu : Carbon::now());
            // $dateDiff = $in->diffAsCarbonInterval($out);
            // $time = Carbon::createFromTime($dateDiff->h, $dateDiff->i, $dateDiff->s)->toTimeString();
            $dateDiff2 = $in->diffInHours($out) . ':' . $in->diff($out)->format('%I:%S');
            
            $sheet->setCellValue('F'.$pos, $history[0]!='skip' ? $dateDiff2 : '-');
            
            // Apply Style ke Row lainnya
            $sheet->getStyle('A'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('B'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('C'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('D'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('E'.$pos)->applyFromArray($style_row);
            $sheet->getStyle('F'.$pos)->applyFromArray($style_row);

            // Set Height Row
            $sheet->getRowDimension($pos)->setRowHeight(20);

            $pos++;
        }

        // Set Width Column ke AutoSize, agar Column menyesuaikan lebar value Row
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $sheet->setTitle('Rekap Pencatatan Parkir - Pekan');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="SI Pencatatan Parkir.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}
