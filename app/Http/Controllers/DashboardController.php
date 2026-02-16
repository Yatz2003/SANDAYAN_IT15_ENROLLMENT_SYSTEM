<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('student_id')) {
            return redirect()->route('login');
        }

        $student = Student::with('courses')->find(session('student_id'));
        $allCourses = Course::all();
        $enrolledCourses = $student->courses;
        $availableCourses = $allCourses->whereNotIn('id', $enrolledCourses->pluck('id'));
        $studentCount = Student::count();
        $courseCount = Course::count();

        return view('dashboard', compact('student', 'enrolledCourses', 'availableCourses', 'studentCount', 'courseCount'));
    }

    public function enroll(Request $request)
    {
        if (!session('student_id')) {
            return redirect()->route('login');
        }

        $data = $request->validate(['course_id' => 'required|exists:courses,id']);
        $student = Student::find(session('student_id'));
        $course = Course::find($data['course_id']);

        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Already enrolled in this course.');
        }

        $enrolledCount = $course->students()->count();
        if ($enrolledCount >= $course->capacity) {
            return back()->with('error', 'Course is full.');
        }

        $student->courses()->attach($course->id);
        return back()->with('success', 'Enrolled in ' . $course->course_name . '!');
    }

    public function drop(Request $request)
    {
        if (!session('student_id')) {
            return redirect()->route('login');
        }

        $data = $request->validate(['course_id' => 'required|exists:courses,id']);
        $student = Student::find(session('student_id'));

        $student->courses()->detach($data['course_id']);
        return back()->with('success', 'Dropped from course.');
    }
}
