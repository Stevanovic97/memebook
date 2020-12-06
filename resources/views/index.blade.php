@extends('layouts.app')

@section('title', 'Meme book')

@section('navbar')
    @include('partials.main-navbar') 
@endsection

@section('sidebar')
    @include('partials.sidebar', ['categories' => $categories])
@endsection

@section('content')
    @include('meme.show-content', ['memes' => $memes])
    @include('meme.report-content', ['reasonsToReport' => $reasonsToReport])
@endsection
