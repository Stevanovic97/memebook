<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Meme</title>
</head>
<body style="">
<div class="col-sm-8">
    <a href="{{url(route('memes.create'))}}">Add New Meme</a>
    <hr>
    @foreach($memes as $meme)
        <a href="{{url(route('memes.single',['id'=>$meme->id]))}}">Show</a>
        <a href="{{url(route('memes.destroy', ['id'=>$meme->id]))}}">Delete</a>
        <div class="meme"
             style="background: black;width: 500px;height: 400px;padding: 15px; color: white; text-align: center;">
            <div class="col-md-8" style="">
                <img style="width: 500px;
  height: 300px;
  object-fit: cover;" src="images/memes{{$meme->image}}" alt=""></div>
            <h1>{{$meme->title}}</h1>
            <h3>{{$meme->body}}</h3>
        </div>
        <br>
    @endforeach
</div>

</body>
</html>
