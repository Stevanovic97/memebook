@extends('layouts.app')

@section('title', 'Memes')

@section('navbar')
    @include('partials.main-navbar') 
@endsection

@section('content')
    @include('meme.show-content', ['memes' => $memes])
@endsection