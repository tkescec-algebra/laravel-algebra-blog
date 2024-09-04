@extends('layout')

@section('content')
    <h1>Welcome to Laravel Blog!</h1>
    <p>
        <a href="{{ route('login') }}">Login</a>
    </p>
@endsection
