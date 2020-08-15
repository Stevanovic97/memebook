@extends('layouts.app')

@section('content')

    <div class="col-sm-8" style="margin: 0 auto;">
        <hr>
        @foreach($memes as $meme)
            <article>
                <header>
                    <div style="height: 20px; color: #999; font-size: 25px; margin-bottom: 15px;">
                        <a href="{{ route('user.single', [ 'id' => $meme->user->id ]) }}">
                            {{ $meme->user->name }}
                        </a>
                    </div>
                    <a href="Show meme route">
                    </a>
                </header>
                <div class="meme"
                     style="width: 600px; position: relative; margin-bottom: 7px; background-color: black; color: white;">
                    <a href="Show meme route">
                        <picture>
                            <div class="col-md-8" style="">
                                <img src="images/memes/{{$meme->image}}" alt="" loading="lazy"
                                     style="width: 500px; height: 450px; object-fit: cover;"></div>
                        </picture>
                    </a>
                    <br><br>
                    <div>
                        <h2>{{$meme->title}}</h2>
                        <br>
                        <h4>{{ $meme->body }}</h4>
                    </div>
                    <p style="color: #999; margin: 0 0 12px;">
                    <a>
                    </a>
                </p>
            </article>
            <div class="col-sm-12" style="margin: 0 auto;">
                <div class="row">
                    <h5 style="color: #666">{{ $meme->upvotes }} points - {{ $meme->comments->count() }} comments</h5>
                </div>
                <div class="row">
                    <div class="row" style="color:whitesmoke">
                        <h2>
                            <a class="btn" href="#" role="button">
                                <i class="fas fa-arrow-circle-up" style="font-size: 2.5em;"></i>
                            </a>
                        </h2>
                        <h2>
                            <a class="btn" href="#" role="button">
                                <i class="fas fa-arrow-circle-down" style="font-size: 2.5em;"></i>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        @include('pagination.default_pagination', ['paginator' => $memes])
    </div>
@endsection
