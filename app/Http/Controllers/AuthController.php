<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('student_id')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|ends_with:@umindanao.edu.ph,@tc.umindanao.edu.ph',
        ]);

        $student = Student::where('email', $data['email'])->first();

        if ($student) {
            session(['student_id' => $student->id, 'student_name' => $student->first_name . ' ' . $student->last_name]);
            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $student->first_name . '!');
        }

        return back()->with('error', 'Student not found. Please register.');
    }

    public function showRegister()
    {
        if (session('student_id')) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'student_number' => 'required|integer|unique:students,student_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|ends_with:@umindanao.edu.ph,@tc.umindanao.edu.ph',
        ]);

        $student = Student::create([
            'student_number' => $data['student_number'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt('password'),
        ]);

        session(['student_id' => $student->id, 'student_name' => $student->first_name . ' ' . $student->last_name]);
        return redirect()->route('dashboard')->with('success', 'Welcome, ' . $student->first_name . '!');
    }

    public function logout()
    {
        session()->forget(['student_id', 'student_name']);
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
