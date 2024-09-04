@extends('layout')

@section('content')
    <h1>Login</h1>
    <form method="POST" action="{{ route('post.login') }}">
        @csrf
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
        <button type="submit">Login</button>
    </form>
@endsection
