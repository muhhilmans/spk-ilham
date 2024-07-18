<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Criteria;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterias = Criteria::all();
        $students = Student::all();

        $grades = Grade::with('student', 'criteria')->get();

        return view('pages.grades.index', [
            'criterias' => $criterias,
            'students' => $students,
            'grades' => $grades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'grade' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->grade > 85) {
            $score = 5;
            $comment = "Sangat Baik";
        } elseif ($request->grade > 75) {
            $score = 3;
            $comment = "Cukup";
        } else {
            $score = 2;
            $comment = "Kurang";
        }

        Grade::create([
            'student_id' => $request->student_id,
            'criteria_id' => $request->criteria_id,
            'grade' => $request->grade,
            'score' => $score,
            'comment' => $comment
        ]);

        return redirect()->route('grades.index')->with('success', 'Penilaian berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $validator = Validator::make($request->all(), [
            'grade' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->grade > 85) {
            $score = 5;
            $comment = "Sangat Baik";
        } elseif ($request->grade > 75) {
            $score = 3;
            $comment = "Cukup";
        } else {
            $score = 2;
            $comment = "Kurang";
        }

        $grade->grade = $request->grade;
        $grade->score = $score;
        $grade->comment = $comment;

        $grade->save();

        return redirect()->route('grades.index')->with('success', 'Penilaian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Grade $grade)
    {
        $grade = Grade::findOrFail($request->grade_id);

        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Penilaian berhasil dihapus!');
    }
}
