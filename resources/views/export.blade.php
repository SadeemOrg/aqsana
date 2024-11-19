<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ rand(0, 99) }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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

        .exit-button:hover .exit-svg path {
            fill: white
        }

        .exit-button:hover {
            color: white
        }

        .TabsSidee a:hover {
            color: #fff
        }

        .TabsSidee a:hover svg path {
            fill: #fff
        }

        .timer svg:hover rect {
            fill: #40b744
        }
    </style>
    @livewireStyles


</head>

<body dir="rtl">
    @if ($key == 'Report')
        @if ($print == 1)
            @livewire('export-report', ['key' => $key, 'ref' => $ref, 'name' => $name, 'from' => $from, 'to' => $to, 'dateType' => $dateType, 'PaymentType' => $PaymentType])
        @else
            @livewire('export-donations', ['key' => $key, 'ref' => $ref, 'name' => $name, 'from' => $from, 'to' => $to, 'dateType' => $dateType, 'PaymentType' => $PaymentType])
        @endif
    @else
        @livewire('export-donations', ['key' => $key, 'ref' => $ref, 'name' => $name, 'from' => $from, 'to' => $to, 'dateType' => $dateType, 'PaymentType' => $PaymentType])
    @endif
    @livewireScripts
    
</body>

</html>