<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterias = Criteria::paginate(10);

        return view('pages.criterias.index', [
            'criterias' => $criterias
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
            'name' => 'required|string|max:255',
            'score' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Criteria::create([
            'name' => $request->name,
            'score' => $request->score
        ]);

        return redirect()->route('criterias.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criteria)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'score' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $criteria->name = $request->name;
        $criteria->score = $request->score;

        $criteria->save();

        return redirect()->route('criterias.index')->with('success', 'Kriteria berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Criteria $criteria)
    {
        $criteria = Criteria::findOrFail($request->criteria_id);

        $criteria->delete();

        return redirect()->route('criterias.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}
