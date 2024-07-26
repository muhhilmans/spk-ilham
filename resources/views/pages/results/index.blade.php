@extends('layouts.app', ['title' => 'Hasil'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Hasil Penilaian</h4>

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

    @foreach ([10, 11, 12] as $class)
        @php
            $studentsInClass = $students->where('class', (string) $class);
        @endphp

        <div class="card px-3 py-2">
            <div class="card-header">
                <h5 class="fw-bold">Kelas {{ $class }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2" class="align-middle">#</th>
                                <th rowspan="2" class="align-middle">Nama Siswa</th>
                                <th colspan="{{ count($criterias) }}" class="text-center">Nilai</th>
                                <th rowspan="2" class="align-middle">Total</th>
                            </tr>
                            <tr class="text-center">
                                @foreach ($criterias as $criteria)
                                    <th>{{ $criteria->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($studentsInClass->count() > 0)
                                @foreach ($studentsInClass as $student)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start"><strong>{{ $student->user->name }}</strong></td>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($criterias as $criteria)
                                            @php
                                                $grade = $student->grades->where('criteria_id', $criteria->id)->first();

                                                $resultGrade = $grade ? $grade->score * ($criteria->score / 100) : '-';
                                            @endphp
                                            <td>{{ $resultGrade }}</td>
                                            @if ($resultGrade !== '-')
                                                @php
                                                    $total += $resultGrade;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <td>{{ $total }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="{{ 3 + count($criterias) }}" class="text-center"><strong>Belum Ada Siswa
                                            di
                                            Kelas {{ $class }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @php
                    $highestTotal = 0;
                    $studentAchievment = '';
                    $description = '';

                    foreach ($studentsInClass as $student) {
                        $total = 0;
                        foreach ($criterias as $criteria) {
                            $grade = $student->grades->where('criteria_id', $criteria->id)->first();
                            if ($grade) {
                                $resultGrade = $grade->score * ($criteria->score / 100);
                                $total += $resultGrade;
                            }
                        }

                        if ($total > $highestTotal) {
                            $highestTotal = $total;
                            $studentAchievment = $student->user->name;
                            $description = "Siswa yang berprestasi yakni <strong>{$studentAchievment}</strong> dengan total nilai <strong>{$highestTotal}</strong> di Kelas {$class}";
                        }
                    }

                    if ($highestTotal == 0) {
                        $description = "Belum ada siswa yang berprestasi di Kelas {$class}.";
                    }
                @endphp

                <p><strong>Keterangan Kelas {{ $class }}:</strong> {!! $description !!}</p>
            </div>
        </div>

        <hr class="my-5" />
    @endforeach
@endsection
