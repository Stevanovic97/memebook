@extends('layouts.app')

@section('content')
    <h2>{{$meme->title}}</h2>
    <h5>{{$meme->body}}</h5>
    <a href="{{url(route('destroy', $meme->id))}}">del</a>
@endsection
