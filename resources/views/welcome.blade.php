<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Listen to the List</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:600|Roboto:400,500&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
        <script src="{{ asset('js/app.js') }}" defer></script>    
        <script src="https://kit.fontawesome.com/48fcdaa9f9.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="app">
            <navbar-component></navbar-component>
            <router-view></router-view>
        </div>
    </body>
</html>
