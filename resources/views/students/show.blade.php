@extends('layouts.app')

@section('title', $student->first_name . ' ' . $student->last_name)

@section('content')
    <div class="card">
        <a href="{{ route('students.index') }}" class="muted">← Back to Students</a>
        <h2>{{ $student->first_name }} {{ $student->last_name }}</h2>
        <p><strong>Student Number:</strong> {{ $student->student_number }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>

        <h3>Enrolled Courses</h3>
        <ul>
            @forelse($student->courses as $course)
                <li class="list-item">{{ $course->course_name }} ({{ $course->course_code }})</li>
            @empty
                <li>No enrollments yet.</li>
            @endforelse
        </ul>

        <h3>Enroll in a Course</h3>
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('students.enroll', $student) }}">
            @csrf
            <div class="form-row">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }}) - capacity {{ $course->capacity }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <button class="btn" type="submit">Enroll</button>
                <a class="btn secondary" href="{{ route('students.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
