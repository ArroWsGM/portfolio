<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="api:url" content="{{ url('/api/1.0') }}/">
    <title>{{ $page_title or 'ArroWs Development Portfolio' }}</title>
    @if(isset($description))
        <meta name="description" content="{{ $description }}">
    @endif
    <link href="{{ url('/favicon.ico') }}" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('/spa/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('/spa/app.css') }}">
</head>
<body>
    <div id="app">
        <p>Please, turn on javascript or update you browser. Also, you can load an <a href="{{ url('/old') }}">older app version</a>.</p>
        <p>Будь ласка, увімкніть Javascript або оновіть Ваш браузер. Крім того, Ви можете завантажити <a href="{{ url('/old') }}"> стару версію сайту</a>.</p>
    </div>

    <script src="{{ mix('/spa/manifest.js') }}"></script>
    <script src="{{ mix('/spa/vendor.js') }}"></script>
    <script src="{{ mix('/spa/app.js') }}"></script>
</body>
</html>