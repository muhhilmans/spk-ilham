@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
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
@endsection
