<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <title>{{ nova_get_setting('Site_name', config('app.name', 'Laravel')) }}</title>

    <link rel="icon" type="image/x-icon" href=" storage/{{ nova_get_setting('main_logo', 'default_value') }}">
    <meta name="description" content="{{ nova_get_setting('Site_description', '') }}" />
    <meta name="keywords" content="{{ nova_get_setting('Site_keywords', '') }}" />
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{ nova_get_setting('Site_link', '') }}">
    <link rel="amphtml" href="{{ nova_get_setting('Site_link', '') }}">
    <base href="{{ nova_get_setting('Site_link', '') }}" target="_blank">

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <link rel="canonical" href="https://aqsana.org/" />
    <meta rel="sitemap" type="application/xml"
        content="https://www.google.com/maps/place/Salah+ad-Din%2FEntry/@32.1287772,34.9666098,15z/data=!4m13!1m7!3m6!1s0x151d30a07d1c8d37:0xe4ff2734981fb335!2sKafr+Bara,+Israel!3b1!8m2!3d32.130911!4d34.970108!3m4!1s0x151d30a7771ae475:0x3a3ffa51d8ced657!8m2!3d32.13195!4d34.965225" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ nova_get_setting('og_site_name', '') }}" />
    <meta itemprop="description" content="{{ nova_get_setting('og_description', '') }}" />
    <meta itemprop="image" content=" storage/{{ nova_get_setting('main_logo', 'default_value') }}" />

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
    <!-- Magnific popup css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css"
        integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- firebase integration started -->

    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>

    <!-- add Print css Link -->
    {{-- <link rel="stylesheet" type="text/css" href="print.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.css"
        integrity="sha512-tKGnmy6w6vpt8VyMNuWbQtk6D6vwU8VCxUi0kEMXmtgwW+6F70iONzukEUC3gvb+KTJTLzDKAGGWc1R7rmIgxQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.css"
        integrity="sha512-zrPsLVYkdDha4rbMGgk9892aIBPeXti7W77FwOuOBV85bhRYi9Gh+gK+GWJzrUnaCiIEm7YfXOxW8rzYyTuI1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-functions.js"></script>


    <!-- firebase integration end -->

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

            @font-face {
                font-family: "Rpt-Bold";
                font-weight: 700px;
                src: url({{ asset('assets/front-end/fonts/ArbFONTS-arbfonts-rpt-Bold.ttf') }});
            }

            .font-FlatBold {
                font-family: 'alfont_com_JF-Flat-Bold' !important
            }

            .font-RpT-Bold {
                font-family: 'Rpt-Bold' !important
            }
        }
    </style>
    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <!-- Datepicker -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ rand(0, 99) }}">
    <link rel="stylesheet" href="{{ asset('assets/front-end/css/main.css') }}?v={{ rand(0, 99) }}">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    @livewireStyles

</head>

<body class="" dir="rtl">
    @include('layout.front-end.partial._Top-header-new')
    {{-- @include('layout.front-end.partial._header') --}}
    @include('layout.front-end.partial._left-sidebar')
    <div class="mt-4">
        @yield('content')
    </div>
    @include('layout.front-end.partial._footer')


    <!-- Comment out (or don't include) services that you don't want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>

    <!-- Magnific popup js -->
    <script src="magnific-popup/jquery.magnific-popup.js"></script>

    <!--Print js -->
    {{-- <script src="print.js"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js"
        integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"
        integrity="sha512-16cHhHqb1CbkfAWbdF/jgyb/FDZ3SdQacXG8vaOauQrHhpklfptATwMFAc35Cd62CQVN40KDTYo9TIsQhDtMFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}?v={{ rand(0, 99) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
        integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <script>
        function readURL(elementId, input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + elementId)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                console.log(input.files[0]);
            }
        }
    </script>
    <!--Paypal  -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=AQrUNiqeaUR5hFL1CRzuAwZQCPQ2KD35hVAM0s_jIhw6mgydgbxvPFVfd3GQ7r3Z-wEyX8FPN3bxJyxL&currency=ILS">
    </script>
    <script>
        // Library Search
        $('#searchLibrary').on('keyup', function() {
            var librarySearchval = $('#searchLibrary').val().toLowerCase();
            if (librarySearchval.length > 2) {
                $('.search-bar').siblings().css('display', 'flex');

                $.ajax({
                    type: "get",
                    url: `/librarysearch/${librarySearchval}`,
                    dataType: "json",
                    beforeSend: function() {
                        $('.search-result-box').html('');
                    },
                    success: function(response) {
                        var elements = response;
                        let searchData = $();
                        for (i = 0; i < elements.length; i++) {
                            console.log(elements[i]);
                            $('.search-result-box').html('');
                            searchData = searchData.add(
                                '<a class="searchList"  target="_self" href="/librarydetail/' +
                                elements[i].id + '">' + elements[i].name + '</br> </a>');
                        }
                        $('.search-result-box').append(searchData)
                    },
                    complete: function() {
                        console.log('searchCompleted')
                    },
                    error: function(err) {
                        console.log('searchError', err)
                    }
                })
            }
        })

        $(document).click(function(e) {

            if (e.target.id != 'searchListId') {
                $("#searchListId").hide();
            }
            if (e.target.id != 'searchLibrary') {
                $("#librarySearchListId").hide();
            }
            if (e.target.id === 'searchLibrary' && screen.width <= 640) {
                $(".selectdiv").hide();
            } else if (e.target.id != 'searchLibrary') {
                $(".selectdiv").show();
            }
        });

        // ajax for Dropdown Search

        $('#bookType').change(function() {
            var id = $(this).val();
            // console.log('id',id)
            // $('#sel_emp').find('option').not(':first').remove();
            // AJAX request
            $.ajax({
                type: "get",
                url: `/librarySearchType/${id}`,
                dataType: "json",
                beforeSend: function() {},
                success: function(response) {
                    // console.log('here')
                    // console.log('here',response)
                    $('#show_cities').html(response);
                }
            })
        })

        var owl = $("#main-home-slider");
        owl.owlCarousel({
            rtl: true,
            autoplay: true,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
        var owl1 = $("#association-news-slider");
        owl1.owlCarousel({
            rtl: true,
            loop: true,
            margin: 30,
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
            rtl: true,
            loop: true,
            margin: 30,
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
            rtl: true,
            loop: false,
            margin: 30,
            stagePadding: 20,
            dots: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                //Medium
                768: {
                    items: 2
                },
                850: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                //Large
                1120: {
                    items: 3
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
        var owl4 = $("#association-news-slider-3");
        owl4.owlCarousel({
            rtl: true,
            loop: false,
            margin: 30,
            stagePadding: 20,
            dots: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                //Medium
                768: {
                    items: 2
                },
                850: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                //Large
                1120: {
                    items: 3
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

        var owl5 = $("#association-news-slider-5");
        owl5.owlCarousel({
            rtl: true,
            loop: false,
            margin: 70,
            stagePadding: 20,
            dots: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                //Medium
                768: {
                    items: 1
                },
                850: {
                    items: 1
                },
                1024: {
                    items: 1
                },
                //Large
                1120: {
                    items: 1
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 2
                }
            }
        })


        $('input[type=radio][name=PaypalRadioInput]').change(function() {
            console.log('this.value', this.value);
            if (this.value == 'payPalv1') {
                $(".btn-btn-payPal").css("display", "block");
                paypal.Buttons({
                    env: 'sandbox', // sandbox | production
                    // Specify the style of the button
                    style: {
                        height: 55,
                        tagline: false,
                        label: 'paypal',
                        size: 'responsive', // small | medium | large | responsive
                        shape: 'pill', // pill | rect
                        color: 'black', // gold | blue | silver | black,
                        layout: 'horizontal' // horizontal | vertical,
                    },
                    client: {
                        sandbox: 'AQrUNiqeaUR5hFL1CRzuAwZQCPQ2KD35hVAM0s_jIhw6mgydgbxvPFVfd3GQ7r3Z-wEyX8FPN3bxJyxL',
                        production: ''
                    },
                    funding: {
                        allowed: [
                            paypal.FUNDING.CARD,
                            paypal.FUNDING.ELV
                        ]
                    },
                    createOrder: (data, actions) => {
                        var amount = $('input[name="PayPal_donation_amount"]').val();
                        if (
                            $('input[name="namePayPal"]').val() == "" || $(
                                'input[name="EmailPayPal"]').val() == "" &&
                            $('input[name="PayPal_donation_amount"]').val() == ""
                        ) {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-bottom-right",
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "2000",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.error(
                                ' الرجاء ادخال الاسم الكامل والمبلغ المراد التبرع فيه و الايميل بشكل صحيح'
                            );
                            return false;
                        } else if (($('input[name="namePayPal"]').val() == "" || $(
                                'input[name="EmailPayPal"]').val() == "") && $(
                                'input[name="PayPal_donation_amount"]').val() != "") {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-bottom-right",
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "2000",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.error(
                                ' الرجاء ادخال الاسم الكامل والايميل بشكل صحيح'
                            );
                            return false;
                        } else {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: amount
                                    }
                                }]
                            });
                        }
                    },
                    onAuthorize: (data, actions) => {
                        return actions.payment.execute().then(function() {});
                    },
                    onApprove: (data, actions) => {
                        return actions.order.capture().then(function(orderData) {
                            // Successful capture! For dev/demo purposes:
                            console.log('Capture result', orderData, JSON
                                .stringify(orderData, null, 2));
                            const transaction = orderData.purchase_units[0]
                                .payments.captures[0];
                            // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                            // When ready to go live, remove the alert and show a success message within this page. For example:
                            // const element = document.getElementById('paypal-button-container');
                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                            // Or go to another URL:  actions.redirect('thank_you.html');
                        });
                    },
                    onError: function(err) {
                        console.log('err', err);
                    }
                }).render('#paypal-button-container');
            }
        })

        function openWindow(url) {
            window.open(url, 'sharer', 'toolbar=0,status=0,width=580,height=400');
            return false;
        };
        $(document).ready(function() {
            $('.img-thumbnail').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
        // first Page Donation
        var pageNumber = 0;
        var previousPage = 0;
        $("#firstPageDonations").click(function() {
            if ($('input[name="donation_amount"]').val() == "") {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error('الرجاء ادخال المبلغ المراد التبرع به');
                return false;
            } else {
                $(".firstPage").hide();
            }
            pageNumber++;
            if (pageNumber == 1) {
                pageNumber = 1
                $(".secondPage").css("display", "flex");
                $(".Ctnbtn").text("تأكيد الدفع");
                var counter = 0;
                $('input[type=radio][name=notification-method]').change(function() {
                    if (this.value == 'payPal') {
                        $(".Ctnbtn").css("display", "none");
                        $(".btn-btn-payPal").css("display", "block");
                        $("input[name=telephone]").attr("type", "hidden");
                        $("input[name=visaid]").attr("type", "hidden");
                        $("input[name=CVV]").attr("type", "hidden");
                        $("input[name=VisaDate]").attr("type", "hidden");

                        var amount = $('input[name="donation_amount"]').val();
                        paypal.Buttons({
                            env: 'sandbox', // sandbox | production
                            // Specify the style of the button
                            style: {
                                height: 55,
                                tagline: false,
                                label: 'paypal',
                                size: 'responsive', // small | medium | large | responsive
                                shape: 'pill', // pill | rect
                                color: 'black', // gold | blue | silver | black,
                                layout: 'horizontal' // horizontal | vertical,
                            },
                            client: {
                                sandbox: 'AQrUNiqeaUR5hFL1CRzuAwZQCPQ2KD35hVAM0s_jIhw6mgydgbxvPFVfd3GQ7r3Z-wEyX8FPN3bxJyxL',
                                production: ''
                            },
                            funding: {
                                allowed: [
                                    paypal.FUNDING.CARD,
                                    paypal.FUNDING.ELV
                                ]
                            },
                            createOrder: (data, actions) => {
                                if ($('input[name="firstName"]').val() == "" || $(
                                        'input[name="lastName"]').val() == "") {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-bottom-right",
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "2000",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    };
                                    toastr.error(' الرجاء ادخال الاسم الاول او الاسم الاخير');
                                    return false;
                                }
                                if ($('#privecy').is(":checked") == false) {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-bottom-right",
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "2000",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    };
                                    toastr.error('الرجاء الموافقة على الشروط والاحكام');
                                    return false;
                                } else {
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: amount
                                            }
                                        }]
                                    });
                                }
                            },
                            onAuthorize: (data, actions) => {
                                return actions.payment.execute().then(function() {});
                            },
                            // onApprove: function(data, actions) {
                            //     return actions.order.capture().then(function(details) {
                            //         alert('Transaction completed by ' + details.payer
                            //             .name.given_name + '!');
                            //     });
                            // },
                            // Finalize the transaction after payer approval
                            onApprove: (data, actions) => {
                                return actions.order.capture().then(function(orderData) {
                                    // Successful capture! For dev/demo purposes:
                                    console.log('Capture result', orderData, JSON
                                        .stringify(orderData, null, 2));
                                    const transaction = orderData.purchase_units[0]
                                        .payments.captures[0];
                                    // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                                    // When ready to go live, remove the alert and show a success message within this page. For example:
                                    // const element = document.getElementById('paypal-button-container');
                                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                    // Or go to another URL:  actions.redirect('thank_you.html');
                                    $(".thirdPage").css("display", "flex");
                                    $(".secondPage").css("display", "none");
                                    $(".Ctnbtn").css("display", "none");
                                    $(".btn-btn-payPal").css("display", "none");
                                    $(".InputValue").html(amount + ".00" +
                                        "شيكل اسرائيلي ");
                                });
                            },
                            onError: function(err) {
                                console.log('err', err);
                            }
                        }).render('#paypal-button-container');
                    } else {
                        $(".Ctnbtn").css("display", "block");
                        $(".btn-btn-payPal").css("display", "none");
                        $("input[name=telephone]").attr("type", "number");
                        $("input[name=visaid]").attr("type", "number");
                        $("input[name=CVV]").attr("type", "number");
                        $("input[name=VisaDate]").attr("type", "text");
                    }
                })
            }
            if (pageNumber == 2) {
                if ($('#privecy').is(":checked") == false && $('.paymentMethod').is(":checked") == false) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error('  الرجاء وضع اشارة صح على شروط الخصوصية والالغاء واختيار طريقة الدفع المناسبة ');
                    pageNumber = 1;
                    return false;
                }
                if ($('#privecy').is(":checked") == false && $('.paymentMethod').is(":checked") == true) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error(' الرجاء وضع اشارة صح على شروط الخصوصية والالغاء ');
                    pageNumber = 1;
                    return false;
                }
                if ($('#privecy').is(":checked") == true && $('.paymentMethod').is(":checked") == false) {
                    console.log($('#privecy').is(":checked") == true && $('.paymentMethod').is(":checked") == false)
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error(' الرجاء اختيار طريقة الدفع المناسبة ');
                    pageNumber = 1;
                    return false;
                } else {
                    var paymentMethod = $('.paymentMethod:checked').val();
                    if (paymentMethod == "payPal") {
                        $(".Ctnbtn").css("display", "none");
                        $(".btn-btn-payPal").css("display", "block");
                    }
                    // console.log($('input[type=radio][name=notification-method]').val())
                    $(".thirdPage").css("display", "flex")
                    $(".secondPage").css("display", "none");
                    $(".Ctnbtn").css("display", "none");
                }
            }
        });
        $("#PreviousPageDonations").click(function() {
            previousPage++;
            if (previousPage == 1) {
                pageNumber = 0;
                previousPage = 0;
                $(".firstPage").show();
                $(".Ctnbtn").attr("disabled", false);
                $(".secondPage").css("display", "none");
                $(".Ctnbtn").text("متابعة");
            }
        });
        $(".closeModal").click(function() {
            $(".contactusModel").css("display", "none");
        })
        $(".showModal").click(function() {
            $(".PrivecySettingModal").toggleClass("hiddenModal");
        });
        $(".tabs .showModal").click(function() {
            $(".PrivecySettingModal .tab").hide();
            if ($(this).data("tab") == 1) {
                $('.ModalContainer').css("max-width", "576px");
            } else {
                $('.ModalContainer').css("max-width", "1280px");
            }
            $('.tab-' + $(this).data('tab')).fadeIn();
        });

        $('#search').on('keyup', function() {
            var val = $('#search').val().toLowerCase();
            if (val.length > 2) {
                $('.search-bar').siblings().css('display', 'flex');
                $.ajax({
                    type: "get",
                    url: '/search/' + val,
                    dataType: 'json',
                    beforeSend: function() {
                        console.log('herererer')
                        $('.search-result-box').html('');
                        $('.svgSearch').css('display', 'none');
                    },
                    success: function(response) {
                        var elements = [];
                        console.log('response', response)
                        response.map(item => {
                            var trimmedString = {
                                trumedTitle: item.title.substring(0, 100),
                                title: item.title,
                                id: item.id
                            };
                            elements.push(trimmedString)
                        })
                        let searchData = $();
                        for (i = 0; i < elements.length; i++) {
                            $('.search-result-box').html('');
                            searchData = searchData.add(
                                '<a class="searchList"  target="_self" href="/categor/' + elements[
                                    i].title + '/' + elements[i].id + '">' + elements[i]
                                .trumedTitle + '</br> </a>');
                        }
                        $('.search-result-box').append(searchData)
                    },
                    complete: function() {
                        console.log('searchCompleted')
                    },
                    error: function(err) {
                        console.log('searchError', err)
                    }
                });
            }
        });
        $(".contactUsForm").submit(function(e) {
            e.preventDefault()
            var $name = $('input[name="name"]').val();
            var $phone = $('input[name="phone"]').val();
            var $message = $('#contuctus-message').val();
            $.ajax({
                type: "get",
                url: "/conctus",
                data: {
                    name: $name,
                    phone: $phone,
                    message: $message
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.success("تم ارسال الرسالة بنجاح");
                    } else {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.error(data.error);
                    }
                },
                error: function() {
                    console.log("err");
                    console.log(data.error);
                }
            })
        })
        $(".LandingPage").submit(function(e) {
            e.preventDefault();
            var $name = $('input[name="name"]').val();
            var $phone = $('input[name="phone"]').val();
            var $city = $('input[name="city"]').val();
            $.ajax({
                type: "get",
                url: "/Almuahada",
                data: {
                    name: $name,
                    phone: $phone,
                    city: $city
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".formInputData").hide();
                        $(".thanksMsg").removeClass("hidden");
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.success("تم ارسال الرسالة بنجاح");
                    } else {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.error(data.error);
                    }
                },
                error: function() {
                    console.log("err");
                    console.log(data.error);
                }
            });
        })
    </script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/datepicker.js"></script>
    <script src="{{ asset('assets/front-end/js/main.js') }}"></script>
    @livewireScripts
</body>
<!-- <script src="{{ mix('/js/app.js') }}"></script> -->

<script>
    Notification.requestPermission().then(function(permission) {
        console.log('permiss', permission)
    });
</script>

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
        .then(function() {
            console.log("Notification permission granted.");
            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            // print the token on the HTML page

            <?php
            if (\Illuminate\Support\Facades\Auth::user() != null) {
            ?>
            $.post({
                url: '{{ url(' / ') }}api/cm-firebase-token',
                data: {
                    fcm_token: token,
                },
                dataType: 'json',
                beforeSend: function() {},
                success: function(response) {
                    console.log(response.body);
                },
                complete: function() {},
            });
            <?php
            } else {
            ?>
            console.log("not Auth")
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
    jQuery(function($) {
        var $firstname = $('input[name="firstName"]');
        var $lastname = $('input[name="lastName"]');
        var $fullname = $('input[name="donor_name"]');
        $firstname.add($lastname).keyup(function() {
            $fullname.val($firstname.val() + ' ' + $lastname.val());
        });
    });
    var height = $(window).height();
    console.log(height)
</script>

</html>
