@extends('layouts.app')

@section('title', 'Single meme')

@section('navbar')
    @include('partials.main-navbar') 
@endsection

@section('content')
    @include('meme.single-content', ['meme' => $meme])
@endsection
