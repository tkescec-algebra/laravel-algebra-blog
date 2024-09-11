@extends('layout', ['admin' => false])

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    @error(['credentials', 'error'])
        <p>{{ $message }}</p>
    @enderror
    <form method="POST" action="{{ route('post.register') }}">
        @csrf
        <div>
            <label for="name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
            @error('first_name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
            @error('last_name')
                <p>{{ $message }}</p>
            @enderror
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('showLogin') }}">Login</a></p>
@endsection
