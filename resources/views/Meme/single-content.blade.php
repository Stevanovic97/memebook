<div>
    <hr>
    <div class="row meme-container">
        <meme-component :meme="{{ $meme }}" 
                        memeimage="{{ URL::to('/') }}/images/memes/{{ $meme->image }}"
                        :user='@json(auth()->user())'
                        single_meme_route="{{ route('meme.single', $meme->id) }}"
                        user_route="{{ route('user.show', $meme->user_id) }}">
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
</div>
