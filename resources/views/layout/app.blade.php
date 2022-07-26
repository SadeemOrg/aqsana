<!DOCTYPE html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <title>{{ nova_get_setting('Site_name', config('app.name', 'Laravel')) }}</title>

    <link rel="icon" type="image/x-icon" href=" storage/{{ nova_get_setting('main_logo', 'default_value')}}">
    <meta name="description" content="{{ nova_get_setting('Site_description', '') }}" />
    <meta name="keywords" content="{{ nova_get_setting('Site_keywords', '') }}" />
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{ nova_get_setting('Site_link', '') }}">
    <link rel="amphtml" href="{{ nova_get_setting('Site_link', '') }}">
    <base href="{{ nova_get_setting('Site_link', '') }}" target="_blank">


    <link rel="canonical" href="https://aqsana.org/" />
    <meta rel="sitemap" type="application/xml"
        content="https://www.google.com/maps/place/Salah+ad-Din%2FEntry/@32.1287772,34.9666098,15z/data=!4m13!1m7!3m6!1s0x151d30a07d1c8d37:0xe4ff2734981fb335!2sKafr+Bara,+Israel!3b1!8m2!3d32.130911!4d34.970108!3m4!1s0x151d30a7771ae475:0x3a3ffa51d8ced657!8m2!3d32.13195!4d34.965225" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ nova_get_setting('og_site_name', '') }}" />
    <meta itemprop="description" content="{{ nova_get_setting('og_description', '') }}" />
    <meta itemprop="image" content=" storage/{{ nova_get_setting('main_logo', 'default_value')}}" />



    <meta property="og:site_name" content="{{ nova_get_setting('og_site_name', '') }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="https://schema.org/WebSite" />
    <meta property="og:description" content="{{ nova_get_setting('og_description', '') }}" />
    <meta property="og:image" content="{{ nova_get_setting('og_image', '') }}" />
    <meta property="og:title" content="Al-Aqsa Association" />
    <meta property="og:locale" content="ar" />
    <meta property="fb:admins" content="{{ nova_get_setting('phone', '') }}" />
    <meta name="theme-color" content="#349A37" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">






    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" />
    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->

    <!-- inter google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- firebase integration started -->

    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-functions.js"></script>

    <!-- firebase integration end -->

    <!-- Comment out (or don't include) services that you don't want to use -->


    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
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
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <!-- Datepicker -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{rand(0, 99)}}">
    <link rel="stylesheet" href="{{ asset('assets/front-end/css/main.css') }}?v={{rand(0, 99)}}">
</head>

<body dir="rtl">
    @include('layout.front-end.partial._header')
    @yield('content')
    @include('layout.front-end.partial._footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}?v={{rand(0, 99)}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        var owl = $("#main-home-slider");
            owl.owlCarousel({
                rtl: true,
                autoplay: true,
                loop:true,
                responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
            });
            var owl1 = $("#association-news-slider");
            owl1.owlCarousel({
                rtl:true,
                loop:true,
                margin:30,
                stagePadding: 20,
                responsive: {
                            //X-Small
                            0: {
                                items: 1
                            },
                            360: {
                                items: 1
                            },
                            375: {
                                items: 1
                            },
                            540: {
                                items: 1
                            },
                            //Small
                            576: {
                                items: 1
                            },
                            //Medium
                            768: {
                                items: 2
                            },
                            850: {
                                items: 2
                            },
                            //Large
                            1120: {
                                items: 2
                            },
                            //Extra large
                            1200: {
                                items: 3
                            },
                            //Extra extra large
                            1400: {
                                items: 3
                            }
                }
            })


        var owl2 = $("#association-news-slider-1");
            owl2.owlCarousel({
                rtl:true,
                loop:true,
                margin:30,
                stagePadding: 20,
                responsive: {
                            //X-Small
                            0: {
                                items: 1
                            },
                            360: {
                                items: 1
                            },
                            375: {
                                items: 1
                            },
                            540: {
                                items: 1
                            },
                            //Small
                            576: {
                                items: 1
                            },
                            //Medium
                            768: {
                                items: 1
                            },
                            850: {
                                items: 2
                            },
                            //Large
                            1120: {
                                items: 2
                            },
                            //Extra large
                            1200: {
                                items: 3
                            },
                            //Extra extra large
                            1400: {
                                items: 3
                            }
                        }
            })


        var owl3 = $("#association-news-slider-2");
        owl3.owlCarousel({
            rtl:true,
            loop:false,
                margin:30,
                stagePadding: 20,
                dots:true,
                responsive: {
                            //X-Small
                            0: {
                                items: 1
                            },
                            360: {
                                items: 1
                            },
                            375: {
                                items: 1
                            },
                            540: {
                                items: 1
                            },
                            //Small
                            576: {
                                items: 1
                            },
                            //Medium
                            768: {
                                items: 1
                            },
                            850: {
                                items: 2
                            },
                            //Large
                            1120: {
                                items: 2
                            },
                            //Extra large
                            1200: {
                                items: 3
                            },
                            //Extra extra large
                            1400: {
                                items: 3
                            }
                        }
            })

            function openWindow(url) {
    window.open(url,'sharer','toolbar=0,status=0,width=580,height=400');
    return false;
};

    </script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/datepicker.js"></script>
    <script src="{{ asset('assets/front-end/js/main.js') }}"></script>
</body>
<!-- <script src="{{ mix('/js/app.js') }}"></script> -->
<script>
    console.log("owais");
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
  navigator.serviceWorker.register("../firebase-messaging-sw.js")
  .then(function(registration) {

    console.log('Registration successful, scope is:', registration.scope);
  }).catch(function(err) {
    console.log('Service worker registration failed, error:', err);
  });
    }
	messaging.requestPermission()
    .then(function () {

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

  $.post({
        url: '{{url('/')}}api/update_fcm_token',
        data: {
            id: "{{Auth::user()->id}}",
            fcm_token: token,
        },
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (response) {

        },
        complete: function () {

        },
    });
    <?php
        } else {


  ?>
  console.log("not Auth")

    <?php
        }
  ?>


    })
    .catch(function (err) {
	console.log("Unable to get permission to notify.", err);
    });

    messaging.onMessage(function(payload) {
    console.log(payload);
    var notify;
    notify = new Notification(payload.notification.title,{
        body: payload.notification.body,
        icon: payload.notification.icon,
        tag: "Dummy"
    });
    console.log(payload.notification);
});

$('#search').on('keyup', function(){
    var val = $('#search').val();
    if(val.length>1){
        $('.search-bar').siblings().css('display','flex');
    $.get({
        url: '{{url('/')}}/search/'+val,
        data: {
            val: val,
        },
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (response) {
            console.log("🚀 ~ file: app.blade.php ~ line 350 ~ $ ~ response", response)
            var elements = '';
            response.map(item=>{
            console.log("🚀 ~ file: app.blade.php ~ line 389 ~ $ ~ item", item)
                var trimmedString =item.title.substring(0, 80);
                elements = elements + '<div class="py-2 cursor-pointer">'+trimmedString+'</div>';
                    $('.search-result-box').append(elements)
                })

        },
        complete: function () {

        },
    });
}
});
</script>

</html>
