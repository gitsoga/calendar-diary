<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @section('sidebar')
            ここがメインのサイドバー
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
