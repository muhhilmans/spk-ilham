@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang {{ auth()->user()->name }}! 🎉</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @hasrole('admin')
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 border border-primary rounded bg-primary">
                                <i class="menu-icon tf-icons bx bx-group p-2 text-white"></i>
                            </div>
                        </div>
                        <span class="d-block mb-1">Users</span>
                        <h3 class="card-title text-nowrap mb-2">{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
        @endhasrole
        <div class="col-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0 border border-info rounded bg-info">
                            <i class="menu-icon tf-icons bx bx-user p-2 text-white"></i>
                        </div>
                    </div>
                    <span class="d-block mb-1">Siswa</span>
                    <h3 class="card-title text-nowrap mb-2">{{ $totalStudents }}</h3>
                </div>
            </div>
        </div>
        @hasrole('admin|guru')
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 border border-danger rounded bg-danger">
                                <i class="menu-icon tf-icons bx bx-cabinet p-2 text-white"></i>
                            </div>
                        </div>
                        <span class="d-block mb-1">Kriteria</span>
                        <h3 class="card-title text-nowrap mb-2">{{ $totalCriterias }}</h3>
                    </div>
                </div>
            </div>
        @endhasrole
    </div>
@endsection
