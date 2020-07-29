<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Make meme</h2>

<form method="post" id="meme-store" action="{{route('memes.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="imageInput">Image</label>
        <input type="file" name="image" class="form-control" id="imageInput">
        {{--            <small id="emailHelp" class="form-text text-muted">Proslediti sliku(meme) koji zelite ubaciti</small>--}}
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
        <h5><b>Choose the category of your meme:</b></h5>
        <select name="category_id" id="selectCategoryId">
            <option value="">Horor</option>
            <option value="">Sport</option>
        </select>
    </div>
    <br>
    <button type="submit" id="btn-meme" class="btn btn-primary">Make Meme</button>
</form>
<div>

</body>
</html>
