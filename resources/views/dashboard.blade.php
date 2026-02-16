@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <div class="card">
        <h2>Welcome, {{ $student->first_name }}!</h2>
        <p class="muted">Student Number: {{ $student->student_number }} | Email: {{ $student->email }}</p>
    </div>

    <!-- Stats -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $enrolledCourses->count() }}</div>
            <div class="stat-label">Enrolled Courses</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $studentCount }}</div>
            <div class="stat-label">Total Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $courseCount }}</div>
            <div class="stat-label">Available Courses</div>
        </div>
    </div>

    <!-- Enrolled Courses -->
    <div class="card">
        <h3>My Enrolled Courses</h3>
        @if($enrolledCourses->count() > 0)
            <div class="courses-grid">
                @foreach($enrolledCourses as $course)
                    <div class="course-card">
                        <h3 style="margin-top: 0;">{{ $course->course_name }}</h3>
                        <div class="course-code">Code: {{ $course->course_code }}</div>
                        <p class="muted">Capacity: {{ $course->students->count() }} / {{ $course->capacity }}</p>
                        <div class="capacity-bar">
                            <div class="capacity-fill" style="width: {{ ($course->students->count() / $course->capacity) * 100 }}%">
                                {{ round(($course->students->count() / $course->capacity) * 100) }}%
                            </div>
                        </div>
                        <div style="margin-top: 12px;">
                            <form method="POST" action="{{ route('dashboard.drop') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="btn" style="background: rgba(211, 47, 47, 0.7); padding: 8px 12px;">Drop</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="muted">You are not enrolled in any courses yet. Browse available courses below!</p>
        @endif
    </div>

    <!-- Available Courses -->
    <div class="card">
        <h3>Available Courses to Enroll</h3>
        @if($availableCourses->count() > 0)
            <div class="courses-grid">
                @foreach($availableCourses as $course)
                    <div class="course-card">
                        <h3 style="margin-top: 0;">{{ $course->course_name }}</h3>
                        <div class="course-code">Code: {{ $course->course_code }}</div>
                        <p class="muted">
                            Capacity: {{ $course->students->count() }} / {{ $course->capacity }}
                            @if($course->students->count() >= $course->capacity)
                                <strong style="color: var(--brand-red);">(Full)</strong>
                            @endif
                        </p>
                        <div class="capacity-bar">
                            <div class="capacity-fill" style="width: {{ ($course->students->count() / $course->capacity) * 100 }}%">
                                {{ round(($course->students->count() / $course->capacity) * 100) }}%
                            </div>
                        </div>
                        <div style="margin-top: 12px;">
                            @if($course->students->count() < $course->capacity)
                                <form method="POST" action="{{ route('dashboard.enroll') }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="btn tertiary">Enroll</button>
                                </form>
                            @else
                                <button class="btn" disabled style="opacity: 0.5;">Full</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="muted">All available courses have been enrolled or none exist.</p>
        @endif
    </div>
@endsection
