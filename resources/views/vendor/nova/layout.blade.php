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

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

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
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}

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
            .room-sort-menu li > a.active {text-decoration: underline}

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
                width: auto;
                background: rgb(21 128 61 / var(--tw-bg-opacity));
                font-size: 0.8em;
                z-index: 1;
            }

            .show {
                display: block;
            }

            .dropMenu li a {
                display: block;
                padding: 7px;
                color: #fff;
                text-decoration: none;
            }

            .dropMenu li a:hover, .dropMenu li a.router-link-active  {
                /* --tw-bg-opacity: 1; */
                background-color: #fff;
                color: #000
            }
            .hide-angle svg.ml-2 {display: none}
            .list-reset {
                max-height: 400px
            }

            .h-header .dropdown-trigger svg{min-width: 10px}
            @media (max-width: 991px) {
                div[x-placement="bottom-start"]{transform: none !important}
                html:not([dir="rtl"]) div[dusk$='index-component'] .btn[dusk='create-button']::before,
                html:not([dir="rtl"]) div[dusk$='index-component'] .btn[dusk='attach-button']::before
                {position: relative; left: 19px; top: 3px}
            }
            table tbody td button {min-width: 125px; font-size: 15px}
            /* Start custom style in tailwind components */
            .custom-class-tabs .card {flex-wrap: wrap}
            .custom-class-tabs .card button {min-width: 200px}
            .table th {font-size: 15px}
            .custom_defaultField > div > div {direction: ltr !important}
            .custom_defaultField {
                width: 100%
            }
            .pl-6 {padding-left: 1.5rem !important}
            .pr-6 {padding-right: 1.5rem !important}
            @media (max-width: 767px) {
                .custom-field-style {width: 100% !important}
                .custom-field-style label {padding-top: 1.5rem}
            }
            .multiselect {text-align: right !important}
            .multiselect .multiselect__tags{padding: 8px 8px 0 40px}
            .w-sidebar {height: 100vh;}
            .w-sidebar .custom-sidebar {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                width: 13.75rem;
                overflow: auto;
                z-index: 99;
            }
            ul.list-reset li > div {border-color: #bacad6 }
            .icons[data-v-b3635f2e] {right: auto !important; left: 0;}

            #filemanager-manager .btn-primary:not([disabled]):not(.btn-disabled), .btn-primary:not([disabled]):not(.btn-disabled) {background-color: #16a34a; font-weight: 500}
            #filemanager-manager .btn-primary:not([disabled]):not(.btn-disabled):hover, .btn-primary:not([disabled]):not(.btn-disabled):hover {background-color: #22c55e}
            #filemanager-manager .btn-default:not([disabled]):not(.btn-disabled):focus, #filemanager-manager .btn-default:not([disabled]):not(.btn-disabled):active
            {
                -webkit-box-shadow: 0 0 0 3px #22c55e
            }

        </style>
<style>
   .reset-button {
    margin-top: 1px;
    margin-right: 3px;
    padding: 2px
    display: flex;
    justify-content: flex-start;
}
  </style>

    <script>
        const iconPath = '{{ asset('alaqsa.PNG') }}';
    </script>

</head>
@php
    $img = 'storage/' . nova_get_setting('Headerlogo', 'default_value');
    $imgRight = 'storage/' . nova_get_setting('HeaderqawafelLogo', 'default_value');
@endphp


<body class="min-w-site bg-40 text-90 font-medium min-h-full">


    <div id="nova">
        <div v-cloak class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="w-sidebar">
                <div class="flex-none pt-header min-h-screen w-full custom-sidebar px-6 bg-green-700">


                    @foreach (\Laravel\Nova\Nova::availableTools(request()) as $tool)
                        {!! $tool->renderNavigation() !!}
                    @endforeach
                </div>
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

                    <dropdown class=" h-9 flex items-center dropdown-right mr-3 hide-angle">

                        @include('nova::partials.Notification')
                    </dropdown>
                    <dropdown class=" h-9 flex items-center dropdown-right">

                        @include('nova::partials.user')
                    </dropdown>
                </div>

                <div data-testid="content custom-content" class="px-view py-view mx-auto">
                    @yield('content')

                    @include('nova::partials.footer')
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/push.min.js') }}"></script>





    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
   <script>
        var firebaseConfig = {
            apiKey: "AIzaSyCUFf82RK4_UHpnJ2EAD1eXgz2tIIBoFaE",
            authDomain: "alaqsa-association.firebaseapp.com",
            databaseURL: 'https://project-id.firebaseio.com',
            projectId: "alaqsa-association",
            storageBucket: "alaqsa-association.appspot.com",
            messagingSenderId: "16943275285",
            appId: "1:16943275285:web:c95070543cf570cb265d1c",
            measurementId: "G-FHN8R2KH3M"
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
    @php
        use App\Models\user;

    @endphp
    @guest
    @else
        @php
            $isToken = Auth::user()->device_key;
        @endphp
        @if (!$isToken)
            <button id="myCheck" onclick="startFCM()" class="hidden">Allow notification
            </button>
            <script>
                document.getElementById("myCheck").click();
            </script>
        @endif

    @endguest
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
        $( document ).ready(function() {
            $('.main-items').click(function() {
                $('.w-sidebar').removeClass('sidebar-hidden');
                $('.main-items').next('.room-sort').slideToggle();
            })
            $('.dropdown .dropBtn, .dropdown').click(function(event) {
                event.preventDefault();
                $('.w-sidebar').removeClass('sidebar-hidden');
                $(this).next('.dropMenu').slideToggle();
            });

            $('.router-link-active').parent().parent('.dropMenu').slideDown()

        });


        // (function() {

        //     var dropBtns = document.querySelectorAll('.dropdown');

        //     function closeOpenItems() {
        //         openMenus = document.querySelectorAll('.dropMenu');
        //         openMenus.forEach(function(menus) {
        //             menus.classList.remove('show');
        //         });
        //     }

        //     dropBtns.forEach(function(btn) {

        //         btn.addEventListener('click', function(e) {
        //             var
        //                 dropContent = btn.querySelector('.dropMenu'),
        //                 shouldOpen = !dropContent.classList.contains('show');
        //             e.preventDefault();

        //             // First close all open items.
        //             closeOpenItems();
        //             // Check if the clicked item should be opened. It is already closed at this point so no further action is required if it should be closed.
        //             if (shouldOpen) {
        //                 // Open the clicked item.
        //                 dropContent.classList.add('show');
        //             }
        //             e.stopPropagation();
        //         });


        //     });

        //     //   close menus when clicking outside of them
        //     window.addEventListener('click', function(event) {
        //         if (event.target != dropBtns) {
        //             // Moved the code here to its own function.
        //             closeOpenItems();
        //         }
        //     });

        // })();
    </script>
    {{-- <script>
        function loadlink() {
            $('#Notification').load('test.php', function() {
                $(this).unwrap();
            });
        }

        // loadlink(); // This will run on page load
        setInterval(function() {
            loadlink() // this will run after every 5 seconds
        }, 10000);
    </script>
    <div id="Notification">
        @php
            use App\Models\Notification;
            $notificationsArray = Notification::where('notifiable_id', Auth::id())
                ->latest()
                ->take(10)
                ->orderBy('created_at', 'ASC')
                ->with('user')
                ->get();

            $receiveNotification = Notification::where([['notifiable_id', Auth::id()], ['receive', null]])->get();

            Notification::where([['notifiable_id', Auth::id()], ['receive', null]])->update(['receive' => 1]);
            $receiveNotificationcount = $receiveNotification->count();

        @endphp

        @if (!$receiveNotificationcount == 0)

            @foreach ($receiveNotification as $notification)
                @php
                    $notificationsArraycount = $notificationsArray->count();
                    $dataNotifications = json_decode($notification->data);
                @endphp

                <script>
                    var bool = {!! json_encode($dataNotifications->Notifications) !!};
                    var bonotificationsArraycountol = {!! json_encode($notificationsArraycount) !!};
                    // toastr.error(bool);

                    // Loading button plugin (removed from BS4)

                    Push.create("Al-Aqsa Association", {
                        body: bool,
                        timeout: bonotificationsArraycountol * 5000,
                        icon: iconPath
                    });
                </script>
            @endforeach
        @endif
    </div> --}}
</body>

</html>
