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
</style>

@php

$books = array(
     array(
         'id' => '1',
         'name' => 'The Alchemist',
         'author' => 'Paulo Coelho',
         'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
         'description'=>'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
         'file'=>'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
        ),

     array(
        'id' => '2',
         'name' => 'The Alchemist',
         'author' => 'Paulo Coelho',
         'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
         'description'=>'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
         'file'=>'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
     ),

     array(
        'id' => '3',
         'name' => 'The Alchemist',
         'author' => 'Paulo Coelho',
         'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
         'description'=>'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
         'file'=>'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
     )
);

$whatsapp_phone = nova_get_setting('whatsapp_Connectus', 'default_value');
$Correct_whatsapp_phone = str_replace(' ', '', $whatsapp_phone);
$Final_Correct_whatsapp_phone = str_replace('-', '', $Correct_whatsapp_phone);
$whatsapp_phone_Link = "https://wa.me/".$Final_Correct_whatsapp_phone ;

@endphp
<!--Content -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2 mt">
    <div class="flex flex-row">
        <ul class="list-reset breadcrumbs flex flex-row font-FlatBold ">
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#101426]">
                <a href="/">الرئيسية</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#349A37]">
           المكتبة
            </li>
        </ul>
    </div>
</div>


<div class="bg-[#F2FFF285] py-8 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative xl:mt-8 mb-7 lg:mb-0">
            <p class="font-FlatBold text-3xl text-center xl:text-right"> المكتبة </p>
            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
        </div>
        @if(empty($books[0]))
        <p class="text-[24px] text-center text-black font-FlatBold w-full pt-16 pl-4">لا يوجد اي
            <span class="text-[#349A37]">كتب </span>
            للعرض
        </p>
        @endif
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-x-8 gap-y-6 text-center lg:text-right">
            <!--first card -->
            @if(!empty($books))
            @foreach ($books as $book )
            @php
            // dd($book);
            // $img = 'storage/'.$Project->report_image;
            $img = $book['cover_photo'];
            // dd($img)
            @endphp
            <div class="p-3 bg-white Card_shadow mt-4 lg:mt-16 relative inline-block iphone13:flex sm:inline-block lg:flex flex-col items-center justify-start rounded-[5px]">
                <div class="absolute leftline"></div>
                <div class="bg-[#E4FFE585] rounded-[5px] py-3 px-4 h-full w-full">
                    <div class="">
                        <img src="{{ asset($img) }}" alt="people_on_Mousq" class="lg:w-[360px] w-full aspect-auto  sm:h-72 max-h-72 rounded-[5px]">
                        <p class="text-[#349A37] text-[32px] pt-4 text-center max-w-none pl-4 ">
                            {{Illuminate\Support\Str::limit($book['name'],113) }}
                        </p>
                        <p class="text-[20px] block sm:hidden md:block text-[#101426] font-noto_Regular pl-4 pt-2 text-center slider-paragraph">
                           {{ $book['author'] }}
                        </p>
                    
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>





@endsection