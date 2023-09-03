<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body class="antialiased">
        <form action="/api/login" method="POST">
            @csrf
            <input style="border: 1px solid black" name="email">
            <input style="border: 1px solid black" name="password">
            <input style="border: 1px solid black" type="submit">
        </form>
    </body>
</html>
