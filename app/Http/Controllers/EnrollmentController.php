<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request, Student $student)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::findOrFail($data['course_id']);

        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Student already enrolled in that course.');
        }

        $enrolledCount = $course->students()->count();
        if ($enrolledCount >= $course->capacity) {
            return back()->with('error', 'Course capacity reached.');
        }

        $student->courses()->attach($course->id);

        return back()->with('success', 'Enrollment successful.');
    }
}
