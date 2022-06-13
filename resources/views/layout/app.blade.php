<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    
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
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('assets/front-end/css/main.css') }}">    
</head>

<body dir="rtl">

    @include('layout.front-end.partial._header')
    @yield('content')
    @include('layout.front-end.partial._footer')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/front-end/js/main.js') }}"></script>
</body>
<!-- <script src="{{ mix('/js/app.js') }}"></script> -->
</html>
