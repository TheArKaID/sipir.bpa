@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Simulasi Parkir</h1>
</div>
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row gutters-sm">
            <div class="col-md-12">
                <form action="{{ route('mahasiswa.simulator.post') }}" method="POST" id="formSimulator">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipe" id="tipe">
                    <div class="row gutters-sm">
                        <div class="col-md-12 mb-3">
                            <label for="id">Kendaraan</label>
                            <select name="id" class="custom-select" required>
                                @foreach ($kendaraan as $k)
                                    <option value="{{ $k->id }}">{{ $k->nomor .' - '. $k->merk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column align-items-center text-center">
                                    <button type="button" id="btnIn" class="btn btn-success"><i class="fa fa-sign-in-alt" style="font-size: 50pt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column align-items-center text-center">
                                    <button type="button" id="btnOut" class="btn btn-danger"><i class="fa fa-sign-out-alt" style="font-size: 50pt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#btnIn').on('click', () => {
            $('#tipe').val('1');
            $('#formSimulator').submit();
        })
        
        $('#btnOut').on('click', () => {
            $('#tipe').val('0');
            $('#formSimulator').submit();
        })
    </script>
@endsection