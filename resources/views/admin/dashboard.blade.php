@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <small><i>Download Report </i>&nbsp; | &nbsp; </small>
        <div class="btn-group mr-2">
            <a href="{{ route('app.dashboard.print', 1) }}" class="btn btn-sm btn-outline-success">Last Week</a>
            <a href="{{ route('app.dashboard.print', 0) }}" class="btn btn-sm btn-outline-success">All</a>
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
        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-success text-center" role="alert">
                    <h4 class="alert-heading">Mahasiswa</h4>
                    <span style="font-size: 50pt">{{ $mahasiswa }}<i class="fa fa-users"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-primary text-center" role="alert">
                    <h4 class="alert-heading">Kendaraan</h4>
                    <div class="row">
                        <div class="col-6">
                            <span style="font-size: 50pt">{{ $vehicles }}</span>
                        </div>
                        <div class="col-6">
                            <i style="font-size: 35pt" class="fa fa-motorcycle"></i><i style="font-size: 35pt" class="fa fa-car-side"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning text-center" role="alert">
                    <h4 class="alert-heading">History Parkiran</h4>
                    <span style="font-size: 50pt">{{ $histories }}<i class="fa fa-history"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-danger text-center" role="alert">
                    <h4 class="alert-heading">Sedang Parkir</h4>
                    <span style="font-size: 50pt">{{ $parked }}<i class="fa fa-parking"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
