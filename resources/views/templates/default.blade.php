<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="main-container">
    <div class="section header">
        <h1>Header</h1>
    </div>
    <div class="section company-info">
        <img src="{{$proposal->company->getFirstMediaUrl('logo')}}" width="200" alt="">
        <div>
            <h1>{{$proposal->name}}</h1>
            <h3>{{$proposal->company->name}}</h3>
        </div>
    </div>
    @foreach($proposal->sections as $section)
        <div class="section mediable">
            <h1>{{$section->name}}</h1>
            @if ($section->type == "Text")
                {!! $section->mediable->value !!}
            @endif
            @if ($section->type == "Image")
                {!! $section->mediable->value !!}
            @endif
            @if ($section->type == "Video")
                {!! $section->mediable->value !!}
            @endif
            @if ($section->type == "Document")
                {!! $section->mediable->value !!}
            @endif
        </div>
    @endforeach
    <div class="section header">
        <h1>Footer</h1>
    </div>
</div>
</body>
</html>
