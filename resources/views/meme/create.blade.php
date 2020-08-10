<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Upload meme</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
    <body>
        <div class="container" style="padding-top: 100px;">
            <form method="post" id="meme-store" action="{{route('meme.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="imageInput">Image</label>
                    <input type="file" name="image" class="form-control" id="imageInput">
                    {{--<small id="emailHelp" class="form-text text-muted">Proslediti sliku(meme) koji zelite ubaciti</small>--}}
                </div>
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" name="title" class="form-control" id="titleInput" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="textInput">Body:</label>
                    <input type="text" name="body" class="form-control" id="textInput" placeholder="Body">
                </div>
                <div>
                    @if (!empty($categories))
                        <h5><b>Choose the category of your meme:</b></h5>
                        <select name="category_id" id="selectCategoryId">
                            @foreach ($categories as $category)
                            {
                                <option value="$category->id">{{ $category->name }}</option>
                            }
                            @endforeach
                        </select>
                    @endif
                </div>
                <br>
                <button type="submit" id="btn-meme" class="btn btn-primary">Make Meme</button>
            </form>
        </div>
    <body>
</html>
