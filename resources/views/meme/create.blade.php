@extends('layouts.app')

@section('title')
    Upload Meme
@endsection

@section('navbar')
    @include('partials.main-navbar') 
@endsection

@section('content')
    @include('meme.create-content')
@endsection