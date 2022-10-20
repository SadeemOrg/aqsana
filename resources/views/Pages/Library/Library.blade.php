@extends('layout.app')
@section('content')
    <style>
        .Card_shadow {
            box-shadow: 0px 0px 1px 0px #0000000A;
            box-shadow: 0px 2px 6px 0px #0000000A;
            box-shadow: 0px 16px 24px 0px #0000000F;
        }

        .leftline {
            /* content:"\A"; */
            width: 13px;
            height: 97.5%;
            background: #349A37;
            right: 10px;
            /* display:inline-block; */
            margin: 0 -32px;
        }



        .selectdiv select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            /* Add some styling */
            background-image: none;
        }
    </style>

    @php
        // dd($book_type[0]);
        // $books = [
        //     [
        //         'id' => '1',
        //         'name' => 'The Alchemist',
        //         'author' => 'Paulo Coelho',
        //         'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
        //         'description' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
        //         'file' => 'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
        //     ],

        //     [
        //         'id' => '2',
        //         'name' => 'The Alchemist',
        //         'author' => 'Paulo Coelho',
        //         'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
        //         'description' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
        //         'file' => 'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
        //     ],

        //     [
        //         'id' => '3',
        //         'name' => 'The Alchemist',
        //         'author' => 'Paulo Coelho',
        //         'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
        //         'description' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
        //         'file' => 'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
        //     ],
        // ];

        $whatsapp_phone = nova_get_setting('whatsapp_Connectus', 'default_value');
        $Correct_whatsapp_phone = str_replace(' ', '', $whatsapp_phone);
        $Final_Correct_whatsapp_phone = str_replace('-', '', $Correct_whatsapp_phone);
        $whatsapp_phone_Link = 'https://wa.me/' . $Final_Correct_whatsapp_phone;

    @endphp
    <!--Content -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2 mt">
        <div class="flex flex-row">
            <ul class="list-reset breadcrumbs flex flex-row font-FlatBold ">
                <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#101426]">
                    <a href="/" target="_self">الرئيسية</a>
                </li>
                <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
                <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#349A37]">
                    المكتبة
                </li>
            </ul>
        </div>
    </div>

    @livewire('type', ['book_type' => $book_type,'books' => $books])
@endsection
