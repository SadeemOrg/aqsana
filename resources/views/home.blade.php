<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<style>
    @layer base {
        @font-face {
            font-family: "alfont_com_JF-Flat-Bold";
            font-weight: 700px;
            src: url('/public/assets/front-end/fonts/alfont_com_JF-Flat-Bold.ttf')
        }

        @font-face {
            font-family: "alfont_com_JF-Flat-regular";
            font-weight: 400px;
            src: url('/public/assets/front-end/fonts/alfont_com_JF-Flat-regular.ttf')
        }

        .font-FlatBold {
            font-family: 'alfont_com_JF-Flat-Bold' !important
        }
    }
</style>

<body>
    @include('layout.front-end.partial._header')
    @include('layout.front-end.partial._top_banner')

    @yield('content')
    @include('layout.front-end.partial.contact-us')
    @include('layout.front-end.partial._footer')

</body>
<!-- <script src="{{ mix('/js/app.js') }}"></script> -->
<script src="{{ asset('js/app.js') }}"></script>
</html>
