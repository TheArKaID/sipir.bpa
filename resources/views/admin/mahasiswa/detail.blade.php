@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Mahasiswa</h1>
</div>
<div class="card">
    <div class="card-body">

    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('app.mahasiswa.simpan', $mahasiswa->id) }}" id="formEdit" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Nama</label>
                            <input type="text" class="form-control" id="editname" name="nama" placeholder="Nama Lengkap"
                                value="{{ old('nama') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="editnim" name="nim" placeholder="20XXXXXXXXX"
                                value="{{ old('nim') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="editemail" name="email"
                                placeholder="name@umy.ac.id" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="editusername" name="username"
                                placeholder="Username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="newpassword" name="password"
                                placeholder="New Password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="repassword">Re New Password</label>
                            <input type="password" class="form-control" id="renewpassword" name="repassword"
                                placeholder="Re New Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection