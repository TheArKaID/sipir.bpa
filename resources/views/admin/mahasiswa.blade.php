@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Mahasiswa</h1>
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

        <div class="col-md-12">
            <div class="row">
                <h3>Data Mahasiswa</h3>
                <button type="button" style="right: 0px; position: absolute" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                    Tambah
                </button>
            </div>
            <div class="table-responsive-md">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Jumlah Kendaraan</th>
                            <th scope="col" style="width: 20%">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>              
        </div>
        
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('app.mahasiswa.tambah') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Nama</label>
                            <input type="text" class="form-control" id="name" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="20XXXXXXXXX" value="{{ old('nim') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@umy.ac.id" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="repassword">Re-Password</label>
                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection