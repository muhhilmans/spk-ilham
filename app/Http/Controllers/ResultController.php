<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Criteria;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $user = auth()->user()->hasRole('siswa');
        $criterias = Criteria::all();

        if ($user) {
            $student = Student::where('user_id', auth()->user()->id)->first();
            $grades = Grade::where('student_id', $student->id)->get();

            return view('pages.results.index', [
                'grades' => $grades,
                'criterias' => $criterias
            ]);
        }

        $students = Student::with('grades.criteria')->get();

        return view('pages.results.index', [
            'students' => $students,
            'criterias' => $criterias
        ]);
    }
}
