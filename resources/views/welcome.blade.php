@extends('layouts.app')

@section('title','Welcome')

@section('content')
    <div class="card">
        <h2>Welcome to the Academic Portal</h2>
        <p class="muted">Manage your courses and academic profile with ease.</p>
    </div>

    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Student::count() }}</div>
            <div class="stat-label">Total Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Course::count() }}</div>
            <div class="stat-label">Available Courses</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Student::withCount('courses')->get()->sum('courses_count') }}</div>
            <div class="stat-label">Active Enrollments</div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="card">
        <h3>Quick Links</h3>
        <div class="courses-grid">
            <div class="course-card">
                <h3 style="margin-top: 0;">Browse Students</h3>
                <p class="muted">View all registered students and their course enrollments.</p>
                <a href="/students" class="btn tertiary" style="display: inline-block; margin-top: 12px;">View Students</a>
            </div>
            <div class="course-card">
                <h3 style="margin-top: 0;">Browse Courses</h3>
                <p class="muted">Explore available courses and see who is enrolled.</p>
                <a href="/courses" class="btn tertiary" style="display: inline-block; margin-top: 12px;">View Courses</a>
            </div>
            <div class="course-card">
                <h3 style="margin-top: 0;">Student Portal</h3>
                <p class="muted">
                    @if(session('student_id'))
                        Manage your enrollments and course selection.
                    @else
                        Login or register to manage your courses.
                    @endif
                </p>
                @if(session('student_id'))
                    <a href="/dashboard" class="btn tertiary" style="display: inline-block; margin-top: 12px;">Go to Dashboard</a>
                @else
                    <a href="/login" class="btn secondary" style="display: inline-block; margin-top: 12px;">Login / Register</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Enrollments -->
    <div class="card">
        <h3>Recent Portal Activity</h3>
        <div style="margin-top: 16px;">
            <p class="muted">Total Students: {{ \App\Models\Student::count() }}</p>
            <p class="muted">Total Courses: {{ \App\Models\Course::count() }}</p>
            <p class="muted">Total Enrollments: {{ \App\Models\Student::withCount('courses')->get()->sum('courses_count') }}</p>
        </div>
    </div>
@endsection
