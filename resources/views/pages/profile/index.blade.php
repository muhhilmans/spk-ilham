@extends('layouts.app', ['title' => 'Profil'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Profil Saya</h4>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        {{-- <h5 class="card-header">Profile Details</h5>
        <hr class="my-0" /> --}}
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ $user->name ?? 'Masukkan Nama Lengkap' }}" autofocus required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="class" class="form-label">Kelas</label>
                        <input class="form-control" type="text" name="class" id="class"
                            value="{{ $user->student->class ?? 'Kelas belum diatur' }}" disabled />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" id="nis" name="nis"
                            value="{{ $user->student->nis ?? 'Masukkan NIS' }}" maxlength="16" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" id="nisn" name="nisn"
                            value="{{ $user->student->nisn ?? 'Masukkan NISN' }}" maxlength="10" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="email" name="email"
                            value="{{ $user->email ?? 'Masukkan E-mail' }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username ?? 'Masukkan Username' }}" />
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="password" name="password"
                                placeholder="Masukkan Password (Jika ingin diubah)" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="password_confirmation"
                                name="password_confirmation" placeholder="Samakan dengan password yang baru dimasukkan"
                                autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
