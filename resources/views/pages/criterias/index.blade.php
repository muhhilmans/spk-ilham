@extends('layouts.app', ['title' => 'Kriteria'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Kelola Kriteria</h4>

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

    <div class="card px-3 py-2">
        <div class="card-header">
            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#createModal"><i
                    class="bx bx-plus"></i> Tambah</button>
            @include('pages.criterias.partials.create')
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($criterias->count() > 0)
                            @foreach ($criterias as $criteria)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start"><strong>{{ $criteria->name }}</strong></td>
                                    <td>{{ $criteria->score }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                            <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $criteria->id }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</button>
                                            @include('pages.criterias.partials.edit')
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $criteria->id }}"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</button>
                                            @include('pages.criterias.partials.delete')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center"><strong>Belum Ada Data</strong></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
