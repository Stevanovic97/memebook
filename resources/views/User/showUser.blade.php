@extends('layouts.app')

@section('content')
<h1>{{$user->name}}</h1>
<h2>{{$user->email}}</h2>
<a href="{{url(route('filter.user', $user->id))}}">Show All Memes</a>
<br>
@if(Auth::user()->id==$user->id)
    <a href="">Edit Profile</a>
@endif


<!-- <form action="{{url(route('notifications'))}}" method="GET">
    <button type="submit">Notifications</button>
</form> -->

@if (auth()->user()->isFollowing($user->id))
                                    <td>
                                        <form action="{{url(route('unfollow', ['id' => $user->id]))}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Unfollow
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <form action="{{url(route('follow', ['id' => $user->id]))}}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-user"></i>Follow
                                            </button>
                                        </form>
                                    </td>
                                @endif


@stop
