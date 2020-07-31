<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>{{$meme->title}}</title>
</head>
<body>
<h2>{{$meme->title}}</h2>
<h5>{{$meme->body}}</h5>
<a href="{{url(route('destroy', $meme->id))}}">del</a>

</body>
</html>
