<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return view('pages.profile.index', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nis' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $student = Student::where('user_id', $user->id)->first();
        $student->nis = $request->nis;
        $student->nisn = $request->nisn;
        $student->save();
        
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
