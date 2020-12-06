@extends('layouts.app')

@section('title')
    Register
@endsection

@section('navbar')
    @include('partials.main-navbar')
@endsection

@section('content')
    @include('auth.register-content')
@endsection
