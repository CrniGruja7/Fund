<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ public_path('css/style.css') }}">
    <title>Fund</title>
</head>
<body>
    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @yield('main')
            </div>
        </div>
    </div>
</body>
</html>