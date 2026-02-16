@extends('layouts.app')

@section('title','Students')

@section('content')
    <div class="card">
        <h2>Students</h2>
        <ul>
            @foreach($students as $student)
                <li class="list-item">
                    <a href="{{ route('students.show', $student) }}">{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_number }})</a>
                    <div class="muted">Enrolled in {{ $student->courses->count() }} course(s)</div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
