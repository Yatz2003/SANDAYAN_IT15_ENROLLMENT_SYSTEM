@extends('layouts.app')

@section('title', $course->course_name)

@section('content')
    <div class="card">
        <a href="{{ route('courses.index') }}" class="muted">← Back to Courses</a>
        <h2>{{ $course->course_name }} ({{ $course->course_code }})</h2>
        <p><strong>Capacity:</strong> {{ $course->capacity }}</p>

        <h3>Enrolled Students</h3>
        <ul>
            @forelse($course->students as $student)
                <li class="list-item">{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_number }})</li>
            @empty
                <li>No students enrolled yet.</li>
            @endforelse
        </ul>
    </div>
@endsection
