@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
    <div class="card" style="max-width: 500px; margin: 60px auto;">
        <h2 style="text-align: center;">Student Login</h2>
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 30px;">Access your academic portal with your UMTC email</p>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
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
                <button type="submit" class="btn" style="width: 100%; text-align: center; cursor: pointer;">Login</button>
            </div>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Don't have an account? <a href="{{ route('register') }}" style="color: var(--brand-yellow); text-decoration: none; font-weight: 600;">Register here</a>
        </p>
    </div>
@endsection
