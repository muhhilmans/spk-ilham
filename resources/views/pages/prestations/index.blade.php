@extends('layouts.app', ['title' => 'Prestasi'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Kelola Prestasi</h4>

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
        @if ($prestations->count() == 0)
            <div class="card-header">
                <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#createModal"><i
                        class="bx bx-plus"></i> Tambah</button>
                @include('pages.prestations.partials.create')
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Cabang Perlombaan</th>
                            <th>Tingkat</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($prestations->count() > 0)
                            @foreach ($prestations as $prestation)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start"><strong>{{ $prestation->branch }}</strong></td>
                                    <td>{{ $prestation->level == 'Nasional' ? 'Nasional/Internasional' : $prestation->level  }}</td>
                                    <td>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center justify-content-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                class="avatar avatar-lg pull-up" title="{{ $prestation->file }}">
                                                <img src="{{ route('prestations.image', $prestation->file) }}"
                                                    alt="{{ $prestation->file }}" class="rounded-circle" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                            <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $prestation->id }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</button>
                                            @include('pages.prestations.partials.edit')
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $prestation->id }}"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</button>
                                            @include('pages.prestations.partials.delete')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center"><strong>Belum Ada Data</strong></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
