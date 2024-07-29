@extends('layouts.app', ['title' => 'Penilaian'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Kelola Penilaian</h4>

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

    @if ($criterias->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
            @foreach ($criterias as $criteria)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title m-0 me-2"><strong>{{ $criteria->name }}</strong></h5>
                                @if ($criteria->name != 'Prestasi')
                                    <button class="btn btn-dark btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#createModal{{ $criteria->id }}"><i class="bx bx-plus"></i>
                                        Tambah</button>
                                    @include('pages.grades.partials.create')
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            @if ($criteria->name == 'Prestasi')
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Cabang Perlombaan</th>
                                            <th>Tingkat</th>
                                            <th>Bukti</th>
                                            <th>Bobot</th>
                                            @else
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Keterangan</th>
                                            <th>Nilai</th>
                                            <th>Bobot</th>
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @php
                                            $hasData = false;
                                            $iteration = 1;
                                        @endphp
                                    
                                        @foreach ($grades as $grade)
                                            @if ($grade->criteria_id == $criteria->id)
                                                @php
                                                    $hasData = true;
                                                @endphp
                                                <tr class="text-center">
                                                    @if ($grade->criteria->name == 'Prestasi')
                                                        @foreach ($prestations as $prestation)
                                                            @if ($prestation->student_id == $grade->student_id)
                                                                <td>{{ $iteration++ }}</td>
                                                                <td class="text-start">
                                                                    <strong>{{ $prestation->student->user->name }}</strong>
                                                                </td>
                                                                <td>{{ $prestation->branch }}</td>
                                                                <td>{{ $prestation->level }}</td>
                                                                <td>
                                                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center justify-content-center">
                                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                                            class="avatar avatar-lg pull-up" title="{{ $prestation->file }}">
                                                                            <img src="{{ route('prestations.image', $prestation->file) }}"
                                                                                alt="{{ $prestation->file }}" class="rounded-circle" />
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                                <td>{{ $grade->score }}</td>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <td>{{ $iteration++ }}</td>
                                                        <td class="text-start">
                                                            <strong>{{ $grade->student->user->name }}</strong>
                                                        </td>
                                                        <td>{{ $grade->comment }}</td>
                                                        <td>{{ $grade->grade }}</td>
                                                        <td>{{ $grade->score }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                                                <button class="btn btn-warning" type="button"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $grade->id }}"><i
                                                                        class="bx bx-edit-alt me-1"></i> Edit</button>
                                                                @include('pages.grades.partials.edit')
                                                                <button class="btn btn-danger" type="button"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $grade->id }}"><i
                                                                        class="bx bx-trash me-1"></i> Delete</button>
                                                                @include('pages.grades.partials.delete')
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    
                                        @if (!$hasData)
                                            <tr>
                                                <td colspan="6" class="text-center"><strong>Belum Ada Data</strong></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row px-3">
            <div class="card">
                <h4 class="text-center pt-4 pb-2"><strong>Belum Ada Data Kriteria</strong></h4>
            </div>
        </div>
    @endif
@endsection
