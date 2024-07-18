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
        $students = Student::with('grades.criteria')->get();
        $criterias = Criteria::all();

        return view('pages.results.index', [
            'students' => $students,
            'criterias' => $criterias
        ]);
    }
}
