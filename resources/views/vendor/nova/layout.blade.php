<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">
    <style>
        .tryThis {
            justify-content: space-between;
        }

        .searchItem {
            margin-right: 5%;
        }

        .imgSideBar {
            margin-left: 4%;
        }
    </style>
    <style>
        .room-sort {
            --tw-bg-opacity: 1;
            background-color: rgb(21 128 61 / var(--tw-bg-opacity));
            margin: 0;
            padding: 0;
            text-align: right;
        }

        .room-sort-menu ul {
            margin: 0;
            padding: 0;
        }

        span.sort {
            /* margin-right: 30px; */
            color: #fff;
            font-weight: 800;
        }

        .sort-mobile {
            display: none;
        }

        /* .room-sort-menu>li {
            display: inline-block;
            color: #fff;
        } */

        .room-sort-menu>li>a {
            display: inline-block;
            /* padding: 16px 30px; */
            margin: 0;
            font-size: 0.8em;
            color: #fff;
            text-decoration: none;
        }

        .room-sort-menu>li>a:hover,
        .room-sort-menu>li>a:focus {}

        .dropdown {
            position: relative;
        }

        .dropMenu {
            position: ;
            display: none;
            top: 46px;
            left: 0px;
            border: 1px solid color;
            width: 109px;
            background: rgb(21 128 61 / var(--tw-bg-opacity));
            font-size: 0.8em;
            z-index: 1;
        }

        .show {
            display: block;
        }

        .room-sort-menu li:last-of-type ul.dropMenu {
            /* width: 166px; */
        }

        .dropMenu li a {
            display: block;
            padding: 7px ;
            color: #fff;
            text-decoration: none;
        }

        .dropMenu li a:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(21 128 61 / var(--tw-bg-opacity));
        }
    </style>
    <!-- Tool Styles -->
    @foreach (\Laravel\Nova\Nova::availableStyles(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <link rel="stylesheet" href="{!! $path !!}">
        @else
            <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
        @endif
    @endforeach

    <!-- Custom Meta Data -->
    @include('nova::partials.meta')

    <!-- Theme Styles -->
    @foreach (\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
    alpha/css/bootstrap.css" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
@php
    $img = 'storage/' . nova_get_setting('Headerlogo', 'default_value');
    $imgRight = 'storage/' . nova_get_setting('HeaderqawafelLogo', 'default_value');

@endphp

<body class="min-w-site bg-40 text-90 font-medium min-h-full">
    <div id="nova">
        <div v-cloak class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="flex-none pt-header min-h-screen  bg-green-700 px-6" style="width: 16rem">


                @foreach (\Laravel\Nova\Nova::availableTools(request()) as $tool)
                    {!! $tool->renderNavigation() !!}
                @endforeach
            </div>
            <!-- Content -->
            <div class="content">
                <div
                    class="tryThis flex items-center justify-between relative shadow h-header bg-white z-20 px-view  lg:h-24">
                    <img class="rounded-full w-24 h-20 lg:block hidden mr-3" src="/{{ $img }}" alt="">
                    @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)
                        <global-search class="searchItem" dusk="global-search-component"></global-search>
                    @endif

                    <div class="ml-auto h-9 flex items-center dropdown-right">
                        <img class="rounded-full w-16 h-12 lg:hidden block mr-8 imgSideBar" src="/{{ $img }}"
                            alt="">
                        <img class="rounded-full w-24 h-20 mr-3 lg:block hidden" src="/{{ $imgRight }}"
                            alt="">
                    </div>

                    <dropdown class=" h-9 flex items-center dropdown-right">

                        @include('nova::partials.Notification')
                    </dropdown>
                    <dropdown class=" h-9 flex items-center dropdown-right">

                        @include('nova::partials.user')
                    </dropdown>
                </div>

                <div data-testid="content" class="px-view py-view mx-auto">
                    @yield('content')

                    @include('nova::partials.footer')
                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyA4a_fkjeIEDYd_avYYZ_XbqwLIhtd6HCQ",
            authDomain: "alqudsquds-82c73.firebaseapp.com",
            databaseURL: 'https://project-id.firebaseio.com',
            projectId: "alqudsquds-82c73",
            storageBucket: "alqudsquds-82c73.appspot.com",
            messagingSenderId: "168567225793",
            appId: "1:168567225793:web:417c87aa992aa0784d4340",
            measurementId: "G-HH0SH5P3KT"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function() {
                    return messaging.getToken()
                })
                .then(function(response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('store.token') }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            alert('Token stored.');

                        },
                        error: function(error) {

                            alert(error);
                            console.log(error);
                        },
                    });
                }).catch(function(error) {
                    alert(error);
                });
        }
        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>
    <script>
        window.config = @json(\Laravel\Nova\Nova::jsonVariables(request()));
    </script>

    <!-- Scripts -->
    <script src="{{ mix('manifest.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('vendor.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('app.js', 'vendor/nova') }}"></script>

    <!-- Build Nova Instance -->
    <script>
        window.Nova = new CreateNova(config)
    </script>

    <!-- Tool Scripts -->
    @foreach (\Laravel\Nova\Nova::availableScripts(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <script src="{!! $path !!}"></script>
        @else
            <script src="/nova-api/scripts/{{ $name }}"></script>
        @endif
    @endforeach

    <!-- Start Nova -->
    <script>
        Nova.liftOff()
    </script>
    <script>
        (function() {

            var dropBtns = document.querySelectorAll('.dropdown');

            function closeOpenItems() {
                openMenus = document.querySelectorAll('.dropMenu');
                openMenus.forEach(function(menus) {
                    menus.classList.remove('show');
                });
            }

            dropBtns.forEach(function(btn) {

                btn.addEventListener('click', function(e) {
                    var
                        dropContent = btn.querySelector('.dropMenu'),
                        shouldOpen = !dropContent.classList.contains('show');
                    e.preventDefault();

                    // First close all open items.
                    closeOpenItems();
                    // Check if the clicked item should be opened. It is already closed at this point so no further action is required if it should be closed.
                    if (shouldOpen) {
                        // Open the clicked item.
                        dropContent.classList.add('show');
                    }
                    e.stopPropagation();
                });


            });

            //   close menus when clicking outside of them
            window.addEventListener('click', function(event) {
                if (event.target != dropBtns) {
                    // Moved the code here to its own function.
                    closeOpenItems();
                }
            });

        })();
    </script>
</body>

</html>
