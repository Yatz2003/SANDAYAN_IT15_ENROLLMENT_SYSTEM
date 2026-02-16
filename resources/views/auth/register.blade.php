@extends('layouts.app')

@section('title', 'Student Registration')

@section('content')
    <div class="card" style="max-width: 600px; margin: 40px auto;">
        <h2 style="text-align: center;">New Student Registration</h2>
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 30px;">Create your account to manage courses</p>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="form-row">
                <label for="student_number">Student Number</label>
                <input 
                    type="number" 
                    id="student_number" 
                    name="student_number" 
                    placeholder="e.g., 123456" 
                    required
                    value="{{ old('student_number') }}"
                >
                @error('student_number')
                    <div class="error" style="margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <label for="first_name">First Name</label>
                <input 
                    type="text" 
                    id="first_name" 
                    name="first_name" 
                    placeholder="John" 
                    required
                    value="{{ old('first_name') }}"
                >
                @error('first_name')
                    <div class="error" style="margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <label for="last_name">Last Name</label>
                <input 
                    type="text" 
                    id="last_name" 
                    name="last_name" 
                    placeholder="Doe" 
                    required
                    value="{{ old('last_name') }}"
                >
                @error('last_name')
                    <div class="error" style="margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="ex: J.doe.145455.tc@umindanao.edu.ph" 
                    required
                    value="{{ old('email') }}"
                >
                @error('email')
                    <div class="error" style="margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <button type="submit" class="btn" style="width: 100%; text-align: center; cursor: pointer;">Create Account</button>
            </div>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--brand-yellow); text-decoration: none; font-weight: 600;">Login here</a>
        </p>
    </div>
@endsection
