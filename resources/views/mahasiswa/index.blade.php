@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>
<div class="card">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h4>History Parkir Anda</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Motor</th>
                    <th scope="col">Status</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $vehicle=0;
                @endphp
                @foreach ($kendaraans as $kendaraan)
                    @if (count($kendaraan->histories)!=0)
                        @for ($i = count($kendaraan->histories)-1; $i > count($kendaraan->histories)-11; $i--)
                        @php
                            if($i<0){
                                break;
                            }
                            $vehicle++;
                            $h = $kendaraan->histories[$i];
                        @endphp
                            <tr>
                                <td>{{$kendaraan->nomor}}</td>
                                <td>{{$h->tipe==App\History::$KENDARAAN_MASUK ? 'Masuk' : 'Keluar'}}</td>
                                <td>{{$h->waktu}}</td>
                            </tr>
                        @endfor
                    @endif
                @endforeach
                @if ($vehicle==0)
                    <tr>
                        <td colspan="2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card border-danger mb-3 text-center">
                                        <div class="card-header bg-danger text-white">Tidak ada History Parkir</div>
                                        <div class="card-body text-danger">
                                            <i class="fa fa-exclamation-circle" style="font-size: 52pt"></i>
                                            <p class="card-text">Sepertinya anda belum Pernah Parkir dengan Kendaraan Ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection