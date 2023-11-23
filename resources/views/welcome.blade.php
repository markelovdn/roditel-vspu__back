<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Echo Example</title>
</head>
<body>
    <ul id="messages"></ul>
    <form id="form" action="">
        <input id="m" autocomplete="off" /><button>Send</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    <script src="//localhost:6001/socket.io/socket.io.js"></script>
    <script>
        $(function(){
        let socket = window.io('http://localhost:6001');
        });
        // socket.on('connection');
        </script>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="//localhost:6001/socket.io/socket.io.js"></script>

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
</html> --}}
