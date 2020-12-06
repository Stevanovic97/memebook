@extends('layouts.app')

@section('navbar')
    @include('partials.main-navbar')
@endsection

@section('content')
    <div class="container">
        <user-profile :memes='@json($memes)'
                      :user='@json($user)'
                      :auth_user='@json(auth()->user())'
                      images_source="{{ URL::to('/') }}/images/memes/"
                      follow_route="{{ route('follow') }}"
                      unfollow_route="{{ route('unfollow') }}"
                      edit_username_route="{{ route('user.editName') }}"
                      edit_password_route="{{route('user.editPassword')}}"
                      show_user_followers="{{route('user.followers')}}"
                      show_user_following="{{route('user.following')}}"
        >
        </user-profile>
    </div>
@endsection
