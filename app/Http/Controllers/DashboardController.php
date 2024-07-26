<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Criteria;
use Illuminate\Http\Request;

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
}
