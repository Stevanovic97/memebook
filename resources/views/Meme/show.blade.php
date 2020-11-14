<div>
    <hr>
    @if (count($memes) != 0)
        @foreach($memes as $meme)
            <div class="row meme-container">
                <meme-component :meme="{{ $meme }}" 
                                :user='@json(auth()->user())'>
                </meme-component>
                <div class="row right-side">
                    <div class="row scrollbar-ripe-malinka">
                        <div id="comments">
                            @include('laravelLikeComment::comment', ['comment_item_id' => $meme->id])
                        </div>  
                    </div>
                    @if(!auth()->guest())
                        <div class="row report-meme">
                            <a id="report_meme_button" class="btn" href="">Report Meme</a>
                        </div>
                    @else
                        <div class="row report-meme">
                            <a id="report_meme_button" class="btn" disabled>Report Meme</a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="centered-element">
            @include('pagination.default_pagination', ['paginator' => $memes])
        </div>
    @else
        @include('partials.memes-not-found')
    @endif
</div>