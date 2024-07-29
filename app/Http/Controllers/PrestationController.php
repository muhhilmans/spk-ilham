<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Grade;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestations = Prestation::where('student_id', auth()->user()->student->id)->get();

        return view('pages.prestations.index', [
            'prestations' => $prestations
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
            'branch' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::transaction(function () use ($request) {
                $fileName = 'prestation_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $filePath = $request->file('image')->storeAs('images/prestations', $fileName, 'public');

                $user = auth()->user();

                $criteria = Criteria::where('name', 'Prestasi')->first();

                if ($request->level == 'Nasional') {
                    $grade = 85;
                    $score = 5;
                    $comment = "Sangat Baik";
                } elseif ($request->level == 'Provinsi') {
                    $grade = 75;
                    $score = 3;
                    $comment = "Cukup";
                } else {
                    $grade = 65;
                    $score = 2;
                    $comment = "Kurang";
                }

                $gradeSave = new Grade();
                $gradeSave->student_id = $user->student->id;
                $gradeSave->criteria_id = $criteria->id;
                $gradeSave->grade = $grade;
                $gradeSave->score = $score;
                $gradeSave->comment = $comment;
                $gradeSave->save();

                $prestation = new Prestation();
                $prestation->student_id = $user->student->id;
                $prestation->grade_id = $gradeSave->id;
                $prestation->branch = $request->branch;
                $prestation->level = $request->level;
                $prestation->file = $fileName;
                $prestation->save();
            });

            return redirect()->route('prestations.index')->with('success', 'Prestasi berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->route('prestations.index')->with('error', 'Prestasi gagal ditambahkan! Error: ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestation $prestation)
    {
        $validator = Validator::make($request->all(), [
            'branch' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        try {
            DB::transaction(function () use ($request, $prestation) {
                if ($request->hasFile('image')) {
                    $fileName = 'prestation_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                    $filePath = $request->file('image')->storeAs('images/prestations', $fileName, 'public');

                    if ($prestation->file && Storage::disk('public')->exists('images/prestations/' . $prestation->file)) {
                        Storage::disk('public')->delete('images/prestations/' . $prestation->file);
                    }
    
                    $prestation->file = $fileName;
                }
    
                $prestation->branch = $request->branch;
                $prestation->level = $request->level;
                $prestation->save();

                $criteria = Criteria::where('name', 'Prestasi')->first();
                $grade = Grade::where('student_id', $prestation->student_id)->where('criteria_id', $criteria->id)->first();

                if ($request->level == 'Nasional') {
                    $grade->grade = 85;
                    $grade->score = 5;
                    $grade->comment = "Sangat Baik";
                } elseif ($request->level == 'Provinsi') {
                    $grade->grade = 75;
                    $grade->score = 3;
                    $grade->comment = "Cukup";
                } else {
                    $grade->score = 2;
                    $grade->comment = "Kurang";
                }
    
                $grade->save();
            });
    
            return redirect()->route('prestations.index')->with('success', 'Prestasi berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->route('prestations.index')->with('error', 'Prestasi gagal diperbarui! Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Prestation $prestation)
    {
        $prestation = Prestation::findOrFail($request->prestation_id);

        $prestation->delete();

        $criteria = Criteria::where('name', 'Prestasi')->first();

        $grade = Grade::where('student_id', $prestation->student_id)->where('criteria_id', $criteria->id)->first();

        $grade->delete();

        return redirect()->route('prestations.index')->with('success', 'Penilaian berhasil dihapus!');
    }
}
