@extends('layouts.app')

@section('content')

<div class="col-sm-8" style="margin: 0 auto;">
    <hr>
    @foreach($memes as $meme)
        <article>
            <header>
                <div style="height: 20px; color: #999; font-size: 12px; margin-bottom: 8px;">
                    <a>
                        User Profile
                    </a>
                </div>
                <a href="Show meme route">
                    <h3>{{$meme->title}}</h3>
                </a>
            </header>
            <div class="meme" style="width: 500px; position: relative; margin-bottom: 8px;">
                <a href="Show meme route" style="min-height: 500px;">
                    <picture>
                        <div class="col-md-8" style="">
                            <img src="images/memes/{{$meme->image}}" alt="" loading="lazy" style="width: 500px; min-height: 500px; object-fit: cover;"></div>
                    </picture>
                </a>
                <div>
                    <h3>{{ $meme->body }}</h3>
                </div>
            </div>
            <p style="color: #999; margin: 0 0 12px;">
                <a>
                    {{ $meme->up_vote }}
                </a>
                <a>
                    Comments count
                </a>
            </p>
            <div style="position: relative; width: 500px;">
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
                    <ul style="float: left; overflow: hidden;">
                    <li>
                        <a data-evt="PostList,TapPost,Hot,,Comment" data-entry-id="aP7xEzG" data-position="3" target="_blank" href="/gag/aP7xEzG#comment" class=" comment badge-evt">
                            Comment
                        </a>
                    </li>
                </ul> 
                </div>
            </div>
        </article>
        <br>
    @endforeach
</div>
@endsection