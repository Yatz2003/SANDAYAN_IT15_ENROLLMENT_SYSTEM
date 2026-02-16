<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $student->load('courses');
        $courses = Course::all();
        return view('students.show', compact('student', 'courses'));
    }
}
