<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>

<body>
    <div class="container">

        <header>Header</header>
        @yield('content')
        <footer>Footer</footer>
    </div>
</body>

</html>
