<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('themes/'.$theme.'/style.css')}}">
</head>
<body>
    @foreach($config->components as $component)
        @include("themes.$theme.partials.$component",['undangan'=>$undangan])
    @endforeach
</body>
</html>
