<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>
    <link rel="icon" type="image/x-icon"
        href="{{ asset('storage/' . nova_get_setting('main_logo', 'default_value')) }}">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">
    <link href="{{ asset('css/appNova.css') }}" rel="stylesheet">

    @foreach (\Laravel\Nova\Nova::availableStyles(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <link rel="stylesheet" href="{!! $path !!}">
        @else
            <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
        @endif
    @endforeach


    @foreach (\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach



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
                <div class=" flex items-center justify-between relative shadow h-header bg-white z-20 px-view  lg:h-24">
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

    <script>
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
        @auth
        @if (!Auth::user()->device_key)
            document.getElementById("myCheck").click();
        @endif
        @endauth
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
        $(document).ready(function() {
            // Handle click event for main items
            $('.main-items').click(function() {
                $('.w-sidebar').removeClass('sidebar-hidden');
                $('.room-sort').slideUp();
                // Remove flipped class from all arrow icons
                $('.arrow-icon').removeClass('flipped');
                $(this).next('.room-sort').slideToggle();
            });

            // Handle click event for dropdown buttons using event delegation
            $(document).on('click', '.dropdown .dropBtn', function(event) {
                event.preventDefault();
                const arrowIcon = $(this).find('.arrow-icon');
                // Toggle flipped class for the clicked arrow icon
                arrowIcon.toggleClass('flipped');
                // Remove flipped class from all other arrow icons
                $('.arrow-icon').not(arrowIcon).removeClass('flipped');
                $('.w-sidebar').removeClass('sidebar-hidden');
                // Close all other dropdown menus
                $('.dropMenu').not($(this).next('.dropMenu')).slideUp();
                // Slide toggle for the clicked dropdown menu
                $(this).next('.dropMenu').slideToggle();
            });

            // Slide down active router links
            $('.router-link-active').parent().parent('.dropMenu').slideDown();
        });
    </script>

</body>

</html>
