@extends('layouts.app')

@section('title','Courses')

@section('content')
    <div class="card">
        <h2>Courses</h2>
        <ul>
            @foreach($courses as $course)
                <li class="list-item">
                    <a href="{{ route('courses.show', $course) }}">{{ $course->course_name }} ({{ $course->course_code }})</a>
                    <div class="muted">Enrolled {{ $course->students->count() }} / {{ $course->capacity }}</div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
