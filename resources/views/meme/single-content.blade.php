<div>
    <hr>
    <div class="row meme-container">
        <meme-component :meme="{{ $meme }}" 
                        memeimage="{{ $meme->sourceImage }}"
                        :user='@json(auth()->user())'
                        single_meme_route="{{ route('meme.single', $meme->id) }}"
                        user_route="{{ route('user.show', $meme->user_id) }}"
                        delete_meme_route="{{ route('meme.delete') }}">
        </meme-component>
        <div class="row right-side">
            <div class="row scrollbar-ripe-malinka">
                <div id="comments">
                    @include('laravelLikeComment::comment', ['comment_item_id' => $meme->id])
                </div>  
            </div>
            @if(!auth()->guest())
                <div class="row report-meme">
                    <button type="button"
                            id="report_meme_button" 
                            class="btn"
                            onclick="ReportMeme({{ $meme->id }});">
                        Report Meme
                    </button>
                </div>
            @else
                <div class="row report-meme">
                    <button type="button" 
                            id="report_meme_button" 
                            class="btn" 
                            onclick="ReportMeme({{ $meme->id }});"
                            disabled>
                        Report Meme
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
