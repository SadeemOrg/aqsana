@php

$text_main = DB::table('settings')->where('key','text_main' )->select('value')->first();
$Almuahada_text_1 = DB::table('settings')->where('key','Almuahada_text_1' )->select('value')->first();
$Almuahada_sup_text_1= DB::table('settings')->where('key','Almuahada_sup_text_1' )->select('value')->first();
$Almuahada_text_2 = DB::table('settings')->where('key','Almuahada_text_2' )->select('value')->first();
$Almuahada_sup_text_2 = DB::table('settings')->where('key','Almuahada_sup_text_2' )->select('value')->first();
$Almuahada_text_3 = DB::table('settings')->where('key','Almuahada_text_3' )->select('value')->first();
$Almuahada_sup_text_3 =DB::table('settings')->where('key','Almuahada_sup_text_3' )->select('value')->first();
$Almuahada_Form_text = DB::table('settings')->where('key','Almuahada_Form_text' )->select('value')->first();
$Almuahada_Form_sup_text =DB::table('settings')->where('key','Almuahada_Form_sup_text' )->select('value')->first();
@endphp
@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false ])
@section('content')

<style>
    .block1 {
        position: absolute;
        left: 50%;
        top: 86px;
    }

    @media screen and (min-width: 1024px) {
        .block1 {
            top: 45px;
            width: 795px;
        }
    }

    @media screen and (min-width: 768px) {
        .block1 {
            width: 70%;
        }
    }

    @media screen and (max-width: 768px) {
        .block1 {
            width: 85%;
        }
    }

    .imgform {
        z-index: 0;
        position: absolute;
        top: 50%;
        --tw-translate-y: -50%;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    @media screen and (min-width: 1024px) {
        .imgform {
            right: -8px;
        }
    }

    .formtext {
        color: white;
        text-align: center;
        z-index: 10;
        position: relative;
    }

    @media screen and (min-width: 1024px) {
        .formtext {
            font-size: 90px;
        }
    }

    @media screen and (max-width: 768px) {
        .formtext {
            font-size: 50px;
        }
    }

    @media screen and (min-width: 640px) {
        .formtext {
            font-size: 40px;
        }
    }
</style>
<div class="bg-green-700 min-h-full bgg" style="background-image:url('https://media.discordapp.net/attachments/938405759996276806/1024261075954319430/D77A8EED_3.png?width=306&height=606') " ;>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 xl:pt-24 ">
        <div class="relative flex justify-center text-white text-[45px] sm:text-[60px] md:text-[80px] lg:text-[160px] ">
            <h1 class="font-RpT-Bold text-center z-10 relative max-w-fit ">
                <span class="relative z-10"> الموحدة أقرب </span>
                <img src="{{ asset('assets/image/blackBg.svg') }}" alt="black_svg" class="z-0 absolute w-[98%] left-[50%] translate-x-[-50%] top-[10%] h-full ">
            </h1>
            <p class="mr-4"> ! </p>
        </div>

        <!-- first Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-9 max-w-full w-full pb-6 sm:pb-0 m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
            <div class="rounded-[50%] h-16 w-16 sm:h-24 sm:w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">1</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
        </div>
        <p class="text-[28px] md:text-[36px] lg:text-[45px] font-RpT-Bold text-[#FFFFFF]">
            @if(!empty($Almuahada_text_1->value))
            {{ $Almuahada_text_1->value }}
            @else
            القائمة العربية الموحدة
            @endif
            <span class="text-[22px] md:text-[24px] lg:text-[36px] font-Flatnormal">
                @if(!empty($Almuahada_sup_text_1->value))
                {{ $Almuahada_sup_text_1->value }}
                @else
                هي الاقرب الى التأثير, حولت العرب الى قوة سياسية تشارك في صنع القرار, وتقدمت خطوه بعد خطوة بالأتجاه الصحيح لنكون لاعبا مركزيا زمؤثرا وحصلت خلال سنة واحدة ميزانيات وقرارت وخطط حكومية غير مسبوقة
                @endif
            </span>
        </p>
        <!-- second Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-9 max-w-full w-full pb-6 sm:pb-0 m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
            <div class="rounded-[50%]  h-16 w-16 sm:h-24 sm:w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">2</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
        </div>
        <p class="text-[28px] md:text-[36px] lg:text-[45px] font-RpT-Bold text-[#FFFFFF]">
            @if(!empty($Almuahada_text_2->value))
            {{ $Almuahada_text_2->value }}
            @else
            نبض الشارع العربي أقرب الى الموحدة
            @endif
            <span class="text-[22px] md:text-[24px] lg:text-[36px] font-Flatnormal">
                @if(!empty($Almuahada_sup_text_2->value))
                {{ $Almuahada_sup_text_2 ->value}}
                @else
                والنهج الواقعي الساعي للمشاركة المؤثرة والفاعلة, هو النهجج المتطابق مع اراء وهموم وتوجهات أغلب أبناء المجتمع العربي
                @endif
            </span>
        </p>
        <!-- third Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-9 max-w-full w-full pb-6 sm:pb-0 m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
            <div class="rounded-[50%]  h-16 w-16 sm:h-24 sm:w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">3</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
        </div>
        <p class="text-[28px] md:text-[36px] lg:text-[45px] font-RpT-Bold text-[#FFFFFF]">
            @if(!empty($Almuahada_text_3->value))
            {{ $Almuahada_text_3->value}}
            @else
            الموحده بأسلوبها العقلاني أقرب الى مواجهة العتصرية,
            @endif
            <span class="text-[22px] md:text-[24px] lg:text-[36px] font-Flatnormal">
                @if(!empty($Almuahada_sup_text_3->value))
                {{ $Almuahada_sup_text_3->value }}
                @else
                من اي أسلوب شعبوي وصدامي أخر, فهو أسلوب يحرج العنصرين, الذين يريدوننا على الهامش, ويحعلنا نحقق انجازات تسد فعليا الفجوات والتمييز
                @endif
            </span>
        </p>
        <!-- start with Form -->
        <div class="pt-28 flex flex-col items-center justify-start relative ">
            <div class="block1 block absolute left-[50%] translate-x-[-50%] top-[86px] lg:top-[45px] w-[85%] md:w-[70%] lg:w-[795px]">
                <div class="relative ">
                    <h3 class=" text-white font-RpT-Bold text-[30px] sm:text-[40px] md:text-[50px] lg:text-[90px] text-center z-10 relative italic">الموحدة أقرب اليك!</h1>
                        <img src="{{ asset('assets/image/smallBlackArea.svg') }}" alt="black_svg" class="imgform ">
                </div>
            </div>
            <form class="pb-28 LandingPage flex flex-col items-center">
                @csrf
                <div class="bg-[#FFD400] w-[95%] h-auto flex flex-col px-4 md:px-14 pb-8 mx-auto">
                    <p class=" mt-14 lg:mt-20 xl:mt-28 text-[24px] sm:text-[28px] md:text-[40px] font-RpT-Bold text-[#000000]">
                        @if(!empty($Almuahada_Form_sup_text->value))
                        {{ $Almuahada_Form_sup_text->value }}
                        @else
                        للأنضمام الى كوادر الموحدة والمشاركة في تحقيق الأنتصار الانتخابي
                        @endif
                    </p>
                    <div class=" ltr pt-4 md:pt-10 lg:px-0">
                        <input type="text" name="name" placeholder="الاسم" class="rtl block w-full  md:h-[65px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-4 md:pt-6  lg:px-0">
                        <input type="text" name="city" placeholder="البلد" class="rtl block w-full md:h-[65px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-4 md:pt-6 pb-10 lg:px-0">
                        <input type="number" name="phone" placeholder="هاتف" class="rtl block w-full md:h-[65px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                </div>
                <button type="submit" class="mt-9 bg-[#000000] text-white text-base sm:text-xl w-[95%]  md:h-[75px] py-4 font-[700] hover:bg-[#101426] duration-200">ارسال</button>
            </form>
        </div>
    </div>
</div>
@endsection