<div class="container" style="padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="form-group">
            <h4>
                <p class="fa fa-exclamation-circle">
                    Create meme by uploading image or by selecting one of the most popular memes
                </p>
            </h4>
        </div>
        <div class="col-md-12">
            <div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="selectMeme" name="chooseMemeType" value="2" class="custom-control-input" checked>
                    <label class="custom-control-label" for="selectMeme">Select meme</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="uploadMeme" name="chooseMemeType" value="1" class="custom-control-input">
                    <label class="custom-control-label" for="uploadMeme">Upload meme</label>
                </div>
            </div>
            <form method="POST" id="meme-store" name="create-meme-form" action="{{ route('meme.store') }}" enctype="multipart/form-data">
                @csrf
                <div id="memeOption1" class="desc" class="form-group" style="display: none;">
                    <label for="imageInput"><b>Image</b></label>
                    <input type="file" name="image" class="form-control" id="imageInput">
                    {{--<small class="form-text text-muted">Proslediti sliku(meme) koji zelite ubaciti</small>--}}
                    @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
                <br/>
                <div id="image-spinner"> 
                    <i class="spinner-border spinner-border fa-spin"></i> Loading images...
                </div>
                <div id="memeOption2" class="form-group desc" style="visibility: hidden;">
                    <div class="bxslider">
                        @foreach ($apiMemeImages as $meme)
                            <div style="display: none" class="carouselImage"><img class="selectedImage" width="500" height="350" src="{{ $meme['url'] }}" title="{{ $meme['name'] }}"></div>
                        @endforeach
                    </div>        
                </div>
                <div class="form-group">
                    <label for="titleInput"><b>Title</b></label>
                    <input type="text"
                           name="title"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                           id="titleInput"
                           placeholder="Title"
                           required
                           autofocus
                           value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="alert">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        </div>  
                    @endif
                </div>
                <div class="form-group">
                    <label for="textInput"><b>Text</b></label>
                    <input type="text" 
                           name="body"
                           class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                           id="textInput"
                           placeholder="Text"
                           required
                           value="{{ old('body') }}">
                    @if ($errors->has('body'))
                        <div class="alert alert-danger">{{ $errors->first('body') }}</div>
                    @endif
                </div>
                <div>
                    @if (!empty($categories))
                        <label for="selectCategoryId"><b>Choose the category of your meme:</b></label>
                        <select class="browser-default custom-select" name="category_id" id="selectCategoryId">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn-meme" class="btn btn-primary btn-block">
                                Create Meme
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>
</div>


