<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

</head>

<body>
<div class="">
    <main class="profile-page">

        <section class="relative block h-500-px">
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                style="
                  background-image: url('https://aqsana.org/wp-content/uploads/2016/11/aqsana_welcome_slider.jpg');
                ">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                style="transform: translateZ(0px)">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>

            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full  pointer-events-none  h-70-px"
                style="transform: translateZ(0px)">


            </div>
            <div class="top-auto bottom-1 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                style="transform: translateZ(0px)">

            </div>
        </section>

        <section class="relative py-16 bg-blueGray-200">
            <div class="container mx-auto px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative">
                                    @php
                                        // dd($user->photo);
                                        $img = 'storage/' . $user->photo;
                                    @endphp
                                    <img alt="..." src="/{{ $img }}"
                                        class="-ml-20 -mt-24 align-middle border-none h-auto lg:-ml-16 max-w-150-px max-w-210-px rounded-full shadow-xl w-auto">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">

                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">

                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                {{ $user->name }}
                            </h3>
                            <h3 class="text-2xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                {{ $user->email }}
                            </h3>
                            <div class="text-sm leading-normal  mb-2 text-blueGray-400 font-bold uppercase mt-2">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                {{ $user->city }}
                            </div>
                            <div class="mb-2 text-blueGray-600 mt-10">
                                <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i> {{ $user->jop }}
                            </div>
                            <div class="mb-2 text-blueGray-600">
                                {{ $user->martial_status }}
                            </div>

                            <div class="mb-2 text-blueGray-600">
                                {{ $user->phone }}
                            </div>
                            <div class="mb-2 text-blueGray-600">
                                {{ $user->birth_date }}
                            </div>
                        </div>
                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">


                                    <a href="/Admin" class="font-normal text-green-600" style=" --tw-text-opacity: 1;
                                    color: rgb(22 163 74 / var(--tw-text-opacity));">ذهاب الى المنظومة</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>
<div class="hidden ">
    <div class="wish">Happy new year</div>
    <div class="NewYear">

        <span>2</span>
        <span class="old">0</span>
        <span class="new">1</span>

    </div>
    <div class="crackers">
        <div class="f1">
            <span><i></i></span>
            <span><i></i></span>
            <span><i></i></span>
        </div>
        <div class="f2">
            <span><i></i></span>
            <span><i></i></span>
            <span><i></i></span>
        </div>
        <div class="f3">
            <span><i></i></span>
            <span><i></i></span>
            <span><i></i></span>
        </div>
        <div class="f4">
            <span><i></i></span>
            <span><i></i></span>
            <span><i></i></span>
        </div>
    </div>
</div>
</body>

</html>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:700|Pacifico');

    *,
    *:after,
    *:before {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        -webkit-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
    }

    .watermarktext {
        color: white;
        position: fixed;
        margin-top: 15%;
        left: 47%;
        font-weight: bold;
        font-size: 20px;
        font-family: cursive;
        font-style: italic;
    }

    .text2 {
        color: white;
        font-size: 15px;
        position: absolute;
        top: 79.5%;
        left: 36%;
        font-weight: bold;
    }

    html {
        background: url(https://cutewallpaper.org/21/starry-night-backgrounds/Starry-Night-Backgrounds-30-+-Background-Pictures-.png);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .wish {
        width: 100%;
        font-family: 'Pacifico', cursive;
        font-size: 100px;
        font-weight: 700;
        color: #f48fb1;
        text-align: center;
        position: fixed;
        top: 50%;
        opacity: 0;
        animation: comes_wish 2s ease-in-out 7s forwards;
    }

    .NewYear {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        padding: 200px 100px 0px 0px;
    }

    .NewYear>span {
        font-family: 'Montserrat', sans-serif;
        font-size: 175px;
        font-weight: 700;
        color: #7a8fe8;
    }

    span.old {
        position: absolute;
        top: 50%;
        right: 50%;
        margin-right: -150px;
        animation: go_2021 5s ease-in-out 5s forwards;
    }

    span.new {
        position: absolute;
        right: 0%;
        margin-right: -150px;
        animation: comes_2022 6s ease-in-out forwards;
    }

    span.new:before {
        content: '';
        width: 0px;
        height: 6px;
        display: block;
        border-radius: 3px;
        background: #7a8fe8;
        transform: rotate(0deg);
        transform-origin: left top;
        position: absolute;
        top: 55px;
        left: 10px;
        z-index: -1;
        animation: delivery_balloon 1s ease-in-out 4s;
    }

    .balloon {
        width: 100px;
        height: 100px;
        display: block;
        background: #e8d57a;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        margin-top: -165px;
        right: 0%;
        margin-right: -200px;
        animation: comes_and_go_balloon 10s ease-in-out forwards;
    }

    .balloon:before {
        content: '';
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 10px 20px 10px;
        border-color: transparent transparent #b19b32 transparent;
        position: absolute;
        left: 50%;
        margin-left: -10px;
        bottom: -10px;
        z-index: -1;
    }

    .balloon:after {
        content: '';
        width: 4px;
        height: 100px;
        display: block;
        background: #fff;
        border-radius: 0px 0px 3px 3px;
        position: absolute;
        left: 50%;
        margin-left: -2px;
        bottom: -110px;
    }

    .crackers {
        width: 100%;
        height: 100%;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
    }

    .crackers>div {
        border: 2px solid #fff;
        position: absolute;
        opacity: 0;
        animation: drop_crackers 1.5s ease-in-out 8s forwards;
    }

    .crackers>div.f1 {
        left: 20%;
        top: 40%;
    }

    .crackers>div.f2 {
        left: 15%;
        top: 70%;
    }

    .crackers>div.f3 {
        right: 20%;
        top: 40%;
    }

    .crackers>div.f4 {
        right: 15%;
        top: 70%;
    }

    .crackers>div span {
        width: 6px;
        height: 6px;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        animation: burst_crackers 0.5s ease-in-out 9s forwards;
    }

    .crackers>div span:nth-child(1) {
        transform: rotate(0deg);
    }

    .crackers>div span:nth-child(2) {
        transform: rotate(120deg);
    }

    .crackers>div span:nth-child(3) {
        transform: rotate(240deg);
    }

    .crackers>div span:before {
        content: '';
        width: 2px;
        height: 50px;
        display: block;
        background: #f5cc06;
        position: absolute;
        top: -60px;
        left: 2px;
    }

    .crackers>div span:after {
        content: '';
        width: 2px;
        height: 50px;
        display: block;
        background: #f5cc06;
        position: absolute;
        bottom: -60px;
        left: 2px;
    }

    .crackers>div span i:before {
        content: '';
        width: 3px;
        height: 3px;
        display: block;
        border-radius: 50%;
        background: #fff;
        position: absolute;
        top: -15px;
        left: 10px;
    }

    .crackers>div span i:after {
        content: '';
        width: 3px;
        height: 3px;
        display: block;
        border-radius: 50%;
        background: #fff;
        position: absolute;
        top: -15px;
        right: 10px;
    }

    @keyframes comes_2022 {
        0% {
            right: 0%;
        }

        66.6666% {
            right: 50%;
            margin-right: -300px;
        }

        90% {
            right: 50%;
            margin-right: -300px;
        }

        100% {
            right: 50%;
        }
    }

    @keyframes comes_and_go_balloon {
        0% {
            right: 0%;
        }

        40% {
            right: 50%;
            margin-right: -300px;
        }

        50% {
            right: 50%;
            margin-right: -200px;
            top: 50%;
        }

        100% {
            top: -100%;
            right: 50%;
        }
    }

    @keyframes delivery_balloon {
        0% {
            transform: rotate(-30deg);
            width: 40px;
        }

        100% {
            transform: rotate(-150deg);
            width: 70px;
        }
    }

    @keyframes go_2021 {
        0% {
            top: 50%;
        }

        100% {
            top: -100%;
        }
    }

    @keyframes comes_wish {
        0% {
            margin-top: 0px;
            opacity: 0;
        }

        100% {
            margin-top: -200px;
            ;
            opacity: 1;
        }
    }

    @keyframes drop_crackers {
        0% {
            margin-top: 100%;
            opacity: 0;
            width: 2px;
            height: 30px;
            display: block;
            border-radius: 50%;
        }

        75% {
            margin-top: 0%;
            opacity: 1;
            width: 2px;
            height: 30px;
            display: block;
            border-radius: 50%;
        }

        80% {
            margin-top: 0px;
            margin-left: 0px;
            opacity: 1;
            width: 10px;
            height: 10px;
            display: block;
            border-radius: 50%;
            transform: scale(0.2);
        }

        100% {
            opacity: 1;
            width: 10px;
            height: 10px;
            display: block;
            border-radius: 50%;
            transform: scale(1);
        }
    }

    @keyframes burst_crackers {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    ul {
        position: fixed;
        top: 80%;
        left: 45%;
        transform: translate(-50%, -50%);
        margin: 0;
        padding: 0;
        display: flex;
    }

    ul li {
        list-style: none;
    }

    ul li a {
        display: block;
        position: relative;
        width: 50px;
        height: 40px;
        line-height: 100px;
        font-size: 40px;
        text-align: center;
        text-decoration: none;
        color: #e74c3c;
        background: transparent;
        margin: 0 30px;
        transition: .1s;
    }

    ul li a span {
        position: absolute;
        transition: transform .5s;
    }

    ul li a span:nth-child(1),
    ul li a span:nth-child(3) {
        width: 100%;
        height: 3px;
        background: #404040;
    }

    ul li a span:nth-child(1) {
        top: 0;
        left: 0;
        transform-origin: right;
    }

    ul li a:hover span:nth-child(1) {
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .5s;
    }

    ul li a span:nth-child(3) {
        bottom: 0;
        left: 0;
        transform-origin: left;
    }

    ul li a:hover span:nth-child(3) {
        transform: scaleX(0);
        transform-origin: right;
        transition: transform .5s;
    }

    ul li a span:nth-child(2),
    ul li a span:nth-child(4) {
        width: 3px;
        height: 100%;
        background: #FF6F61;
    }

    ul li a span:nth-child(2) {
        top: 0;
        left: 0;
        transform: scale(0);
        transform-origin: bottom;
    }

    ul li a:hover span:nth-child(2) {
        transform: scale(1);
        transform-origin: top;
        transition: transform .5s;
    }

    ul li a span:nth-child(4) {
        top: 0;
        right: 0;
        transform: scale(0);
        transform-origin: top;
    }

    ul li a:hover span:nth-child(4) {
        transform: scale(1);
        transform-origin: bottom;
        transition: transform .5s;
    }

    .instagram:hover {
        color: #c32aa3;
    }

    .instagram:hover span {
        background: #1abc9c;
    }
</style>