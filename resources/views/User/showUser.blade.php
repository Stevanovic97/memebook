<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>{{$user->name}}</h1>
<h2>{{$user->email}}</h2>
<a href="{{url(route('filter.user', $user->id))}}">Show All Memes</a>
<br>
@if(Auth::user()->id==$user->id)
    <a href="">Edit Profile</a>
@endif
</body>
</html>
