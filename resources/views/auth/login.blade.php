@extends('layouts.app')

@section('title')
    Login
@endsection

@section('navbar')
    @include('partials.main-navbar') 
@endsection

@section('content')
    @include('auth.login-content')
@endsection
