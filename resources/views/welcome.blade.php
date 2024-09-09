@extends('layout')

@section('content')
    <h1>Welcome to Laravel Blog!</h1>
    @auth
        <p>Welcome, {{ auth()->user()->first_name }}!</p>
        {{-- <p><a href="{{ route('post.create') }}">Create a new post</a></p> --}}
        <p><a href="{{ route('logout') }}">Logout</a></p>
    @else
        <p>
            <a href="{{ route('showLogin') }}">Login</a> |
            <a href="{{ route('register') }}">Register</a>
        </p>
    @endauth
@endsection
