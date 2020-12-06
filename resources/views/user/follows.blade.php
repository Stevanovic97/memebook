@extends('layouts.app')

@section('title', 'Follows');

@section('navbar')
    @include('partials.main-navbar')
@endsection

@section('content')

    <div class="container" style="padding-top: 50px;">
        <h1 style="text-align: center;">Following</h1>
        @foreach ($follows as $f)
            <div style="display: flex; flex-direction: row; width: 1000px">
                <div style="display: flex; flex-direction: row; flex-grow: 2;">
                    <h3 style="width: 1000px">
                        <img style="border-radius:50%; width:4%; height:90%;"
                             src="{{URL::to('/') }}{{$f->avatar}}">
                        <a href="{{route('user.show', $f->id)}}"><b>{{$f->name}}</b></a>
                        followed at: <i>{{substr($f->created_at,0,9)}}</i>
                    </h3>
                </div>
                <div style="display: flex; flex-direction: row; flex-grow: 2;">
                    <follow-component :user="{{$f}}"
                                      :auth_user="{{auth()->user()}}"
                                      follow_route="{{route('follow')}}"
                                      unfollow_route="{{route('unfollow')}}"

                    ></follow-component>
                </div>
            </div>
            <br>
        @endforeach

    </div>

@endsection
