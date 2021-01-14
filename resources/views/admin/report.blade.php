@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Rekapan</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <small><i>Download Report </i>&nbsp; | &nbsp; </small>
        <div class="btn-group mr-2">
            <a href="{{ route('app.report.print', 1) }}" class="btn btn-sm btn-outline-success">Last Week</a>
            <a href="{{ route('app.report.print', 0) }}" class="btn btn-sm btn-outline-success">All</a>
        </div>
        {{-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
        </button> --}}
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="row">
                <h3>Rekap Data</h3>
            </div>
            <div class="table-responsive-md">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No. Polisi</th>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                            <th scope="col">Lama Parkir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($histories)!=0)
                        @foreach ($histories as $key => $history)
                        @php
                            $row = $history[0]!='skip' ? 0 : 1;
                        @endphp
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$history[$row]->kendaraan->mahasiswa->nama}}</td>
                                <td>{{$history[$row]->kendaraan->nomor}}</td>
                                <td>{{$history[0]!='skip' ? $history[0]->waktu : '-'}}</td>
                                <td>{{array_key_exists(1, $history) ? $history[1]->waktu : '-'}}</td>
                                @php
                                    $in = Carbon\Carbon::createFromTimeString($history[0]!='skip' ? $history[0]->waktu : Carbon\Carbon::now());
                                    $out = Carbon\Carbon::createFromTimeString(array_key_exists(1, $history) ? $history[1]->waktu : Carbon\Carbon::now());
                                    $dateDiff2 = $in->diffInHours($out) . ':' . $in->diff($out)->format('%I:%S');
                                @endphp
                                <td>{{$history[0]!='skip' ? $dateDiff2 : '-'}}</td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                @if (count($histories)==0)
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card border-danger mb-3 text-center">
                            <div class="card-header bg-danger text-white">Tidak ada Data Rekapan</div>
                            <div class="card-body text-danger">
                                <i class="fa fa-question" style="font-size: 52pt"></i>
                                <p class="card-text">Belum ada Catatan Rekapan Parkir</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                @endif
            </div>          
        </div>
    </div>
</div>
@endsection
