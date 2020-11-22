@extends('layouts.app')

@section('navbar')
    @include('partials.main-navbar')    
@endsection

@section('content')
    <div class="container">
        <user-profile :memes='@json($memes)'
                      :user='@json($user)'
                      :auth_user='@json(auth()->user())'
                      follow_route="{{ route('follow') }}"
                      unfollow_route="{{ route('unfollow') }}"
                      images_source="{{ URL::to('/') }}/images/memes/"
                      >
        </user-profile>
    </div>
@endsection