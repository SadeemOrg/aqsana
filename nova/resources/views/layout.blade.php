<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AlAqsa Control Panel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
        rel="stylesheet">

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

    <!-- firebase integration started -->

    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-functions.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}?v={{ rand(0, 99) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    {{-- <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css"> --}}
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
<!-- firebase integration end -->
</head>
<body class="min-w-site bg-40 text-90 font-medium min-h-full">
    <div id="nova">
        <div v-cloak class="flex min-h-screen ">
            <!-- Sidebar -->

            <div class="flex-none pt-header min-h-screen w-sideba bg-green-700 px-6 w-1/6" >




                @foreach (\Laravel\Nova\Nova::availableTools(request()) as $tool)
                    {!! $tool->renderNavigation() !!} @endforeach
            </div>
            @php
                $img = 'storage/' . nova_get_setting('logo', 'default_value');
                $imgRight = 'storage/' . nova_get_setting('qawafelLogo', 'default_value');
                // dd($imgRight);
            @endphp
            <!-- Content -->
            <div class="content ">
                <div class="flex items-center relative shadow  bg-white z-20 ">

                    <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}" >
                        <div class=" ml-12 justify-end w-1/5 mr-10">
                            {{-- <a target="_self" href="/Qawafel-Alaqsa">
                                <img class="w-23 h-23" src="/{{ $img }}" />
                            </a> --}}
                            <a class=" flex flex-row items-center justify-center h-24 w-32 cursor-pointer"
                    onclick="location.href='#'">
                    <img class="h-full  " src="/{{ $img }}" alt="">
                </a>
                        </div>
                                        </a>

                     @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)
    <global-search dusk="global-search-component"></global-search>
    @endif

    <div class=" flex justify-end w-4/12 mr-10">


    </div>

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
    <script>
        // Fetch all the details element.
        const details = document.querySelectorAll("details");

        // Add the onclick listeners.
        details.forEach((targetDetail) => {
            targetDetail.addEventListener("click", () => {
                // Close all the details that are not targetDetail.
                details.forEach((detail) => {
                    if (detail !== targetDetail) {
                        detail.removeAttribute("open");
                    }
                });
            });
        });
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
        Notification.requestPermission().then(function(permission) {
            console.log('permiss', permission)
        });
    </script>

    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyCUFf82RK4_UHpnJ2EAD1eXgz2tIIBoFaE",
            authDomain: "alaqsa-association.firebaseapp.com",
            projectId: "alaqsa-association",
            storageBucket: "alaqsa-association.appspot.com",
            messagingSenderId: "16943275285",
            appId: "1:16943275285:web:c95070543cf570cb265d1c",
            measurementId: "G-FHN8R2KH3M"
        };

        firebase.initializeApp(firebaseConfig);



        const messaging = firebase.messaging();

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register("../../firebase-messaging-sw.js")
                .then(function(registration) {

                    console.log('Registration successful, scope is:', registration.scope);
                }).catch(function(err) {
                    console.log('Service worker registration failed, error:', err);
                });
        }
        messaging.requestPermission()
            .then(function() {

                console.log("Notification permission granted.");

                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token) {
                // print the token on the HTML page
                console.log(token);

                <?php
 if(\Illuminate\Support\Facades\Auth::user() != null) {


?>


                $.ajax({
                    url: '{{ url('/') }}/api/cm-firebase-token-nova',
                    type: 'PUT',
                    data: {
                        id: "{{ Auth()->id() }}",
                        fcm_token: token,
                    },
                    dataType: 'json',
                    beforeSend: function() {},
                    success: function(response) {

                    },
                    complete: function() {

                    },
                });
                <?php
      } else {


?>


                <?php
      }
?>


            })
            .catch(function(err) {
                console.log("Unable to get permission to notify.", err);
            });

        messaging.onMessage(function(payload) {
            console.log(payload);
            var notify;
            notify = new Notification(payload.notification.title, {
                body: payload.notification.body,
                icon: payload.notification.icon,
                tag: "Dummy"
            });
            console.log(payload.notification);
        });
    </script>


    </body>

</html>
