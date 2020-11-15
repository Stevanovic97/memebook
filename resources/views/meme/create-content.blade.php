<div class="container" style="padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" id="meme-store" action="{{ route('meme.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="imageInput"><b>Image</b></label>
                    <input type="file" name="image" class="form-control" id="imageInput">
                    {{--<small class="form-text text-muted">Proslediti sliku(meme) koji zelite ubaciti</small>--}}
                </div>
                <div class="form-group">
                    <label for="titleInput"><b>Title</b></label>
                    <input type="text" name="title" class="form-control" id="titleInput" placeholder="Title">
                    @if ($errors->has('title'))
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="textInput"><b>Text</b></label>
                    <input type="text" name="body" class="form-control" id="textInput" placeholder="Text">
                    @if ($errors->has('body'))
                            <div class="alert alert-danger">{{ $errors->first('body') }}</div>
                    @endif
                </div>
                <div>
                    @if (!empty($categories))
                        <label for="selectCategoryId"><b>Choose the category of your meme:</b></label>
                        <select class="browser-default custom-select" name="category_id" id="selectCategoryId">
                            @foreach ($categories as $category)
                            {
                                <option value="{{$category->id}}">{{ $category->name }}</option>
                            }
                            @endforeach
                        </select>
                    @endif
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn-meme" class="btn btn-primary btn-block">Create Meme</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>
</div>