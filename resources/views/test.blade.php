<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog!</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<body>
    <h1>Blog Gem!</h1>
    <h2>{{$posts}}</h2>

    <div class="flex flex-row gap-5 c-red">
        @foreach($comments as $comments)
            <p>{{$comments}}</p>
        @endforeach
    </div>
</body>
</html>