@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Kendaraan</h1>
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
            <div class="col-md-4 mb-1">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="mt-1">
                                <form action="{{ route('mahasiswa.kendaraan.simpan', $kendaraan->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-12">
                                        <label for="jenis">Jenis Kendaraan</label>
                                        <select name="jenis" class="custom-select" required>
                                            <option value="1" {{ $kendaraan->jenis==App\Kendaraan::$JENIS_RODA_DUA ? 'selected' : ''}}>Roda Dua</option>
                                            <option value="2" {{ $kendaraan->jenis==App\Kendaraan::$JENIS_RODA_EMPAT ? 'selected' : ''}}>Roda Empat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="Merk">Merk Kendaraan</label>
                                        <input type="text" class="form-control" id="Merk" name="merk" placeholder="Merk Kendaraan" value="{{ $kendaraan->merk }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="Nomor">Nomor Kendaraan</label>
                                        <input type="text" class="form-control" id="Nomor" name="nomor" placeholder="Nomor Kendaraan" value="{{ $kendaraan->nomor }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-success col-md-12 mb-1">Simpan</button>
                                        <button type="button" class="btn btn-danger col-md-12" data-toggle="modal" data-target="#deleteModal">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row gutters-sm">
                    <div class="col-sm-12 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-info mr-2">History Parkir</i>
                                </h6>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nomor</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if (count($mahasiswa)!=0)
                                        @foreach ($mahasiswa as $m)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{$m->nama}}</td>
                                                <td>{{$m->nim}}</td>
                                                <td>{{0}}</td>
                                                <td>
                                                    <a href="{{ route('app.mahasiswa.edit', $m->id) }}" id="btnEdit" class="btn btn-warning">Edit</a>
                                                    <a onclick="deleteMe('{{ route('app.mahasiswa.hapus', $m->id) }}')"  class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kendaraan ini ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mahasiswa.kendaraan.hapus', $kendaraan->id) }}" id="deleteForm" method="POST">
                {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection