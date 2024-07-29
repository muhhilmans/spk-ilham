<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = Student::count();
        $totalCriterias = Criteria::count();
        
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
            'totalCriterias' => $totalCriterias
        ]);
    }

    public function getPrestation($filename)
    {
        $path = 'images/prestations/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($path);
        $type = Storage::disk('public')->mimeType($path);

        return response($file, 200)->header("Content-Type", $type);
    }
}
