@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Mahasiswa</h1>
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
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <i class="fa fa-user-tie rounded-circle" style="font-size: 100pt"></i>
                            <div class="mt-3">
                                <h4>{{ $mahasiswa->nama }}</h4>
                                <p class="text-secondary mb-1">{{ "@".$mahasiswa->username }}</p>
                                <p class="text-muted font-size-sm">{{ $mahasiswa->email }}</p>
                                <button data-toggle="modal" data-target="#editModal" class="btn btn-warning">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row gutters-sm">
                    
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-info mr-2">Kendaraan</i> Roda 2
                                </h6>
                                @php
                                    $K1 = 0;
                                    $K2 = 0;
                                @endphp
                                @foreach ($mahasiswa->kendaraans as $k)
                                @if ($k->jenis==App\Kendaraan::$JENIS_RODA_DUA)
                                    @php
                                        $K1++;
                                    @endphp
                                    <a href="{{ '#'. $k->id }}">
                                        <small>{{ $k->nomor }}</small> ({{ $k->merk }})
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </a>
                                @endif
                                @endforeach
                                @if ($K1==0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-danger mb-3 text-center">
                                                <div class="card-header bg-danger text-white">Tidak ada Kendaraan</div>
                                                <div class="card-body text-danger">
                                                    <i class="fa fa-motorcycle" style="font-size: 52pt"></i>
                                                    <p class="card-text">Anda Tidak Memiliki Kendaraan Roda 2</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-info mr-2">Kendaraan</i> Roda 4
                                </h6>
                                @foreach ($mahasiswa->kendaraans as $k)
                                @if ($k->jenis==App\Kendaraan::$JENIS_RODA_EMPAT)
                                @php
                                    $K2++;
                                @endphp
                                    <a href="{{ '#'. $k->id }}">
                                        <small>{{ $k->nomor }}</small> ({{ $k->merk }})
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </a>
                                @endif
                                @endforeach
                                @if ($K2==0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-danger mb-3 text-center">
                                                <div class="card-header bg-danger text-white">Tidak ada Kendaraan</div>
                                                <div class="card-body text-danger">
                                                    <i class="fa fa-car-side" style="font-size: 52pt"></i>
                                                    <p class="card-text">Anda Tidak Memiliki Kendaraan Roda 4</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-sm">
            <div class="col-md-12 mb-3">
                <p>
                    <h5>History Kendaraan</h5>
                </p>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Status</th>
                                    <th scope="col">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $vehicle = 0;
                                @endphp
                                @foreach ($mahasiswa->kendaraans as $kendaraan)
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
                                                <td>{{$h->tipe==App\History::$KENDARAAN_MASUK ? 'Masuk' : 'Keluar'}}</td>
                                                <td>{{$h->waktu}}</td>
                                            </tr>
                                        @endfor
                                    @else
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
            </div>
        </div>
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
                                value="{{ old('nama') ?? $mahasiswa->nama }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="editnim" name="nim" placeholder="20XXXXXXXXX"
                                value="{{ old('nim') ?? $mahasiswa->nim }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="editemail" name="email"
                                placeholder="name@umy.ac.id" value="{{ old('email') ?? $mahasiswa->email }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="editusername" name="username"
                                placeholder="Username" value="{{ old('username') ?? $mahasiswa->username }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="newpassword" name="password"
                                placeholder="New Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="repassword">Re New Password</label>
                            <input type="password" class="form-control" id="renewpassword" name="repassword"
                                placeholder="Re New Password">
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