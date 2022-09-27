@php
$text_main = nova_get_setting('text_main', 'default_value');
$Almuahada_text_1 = nova_get_setting('Almuahada_text_1', 'default_value');
$Almuahada_sup_text_1= nova_get_setting('Almuahada_sup_text_1', 'default_value');
$Almuahada_text_2 = nova_get_setting('Almuahada_text_2', 'default_value');
$Almuahada_sup_text_2 = nova_get_setting('Almuahada_sup_text_2', 'default_value');
$Almuahada_text_3 = nova_get_setting('Almuahada_text_3', 'الاسم كامل');
$Almuahada_sup_text_3 = nova_get_setting('Almuahada_sup_text_3', 'رقم الهاتف');
$Almuahada_Form_text = nova_get_setting('Almuahada_Form_text', 'الاسم كامل');
$Almuahada_Form_sup_text = nova_get_setting('Almuahada_Form_sup_text', 'رقم الهاتف');
@endphp
@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false ])
@section('content')


<style>

</style>
<div class="bg-green-700 min-h-full bgg" style="background-image:url('https://media.discordapp.net/attachments/938405759996276806/1024261075954319430/D77A8EED_3.png?width=306&height=606') " ;>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 xl:pt-24 ">
        <div class="relative">
            <h1 class="text-white text-[30px] sm:text-[50px] md:text-[80px] lg:text-[160px] font-RpT-Bold text-center z-10 relative max-w-fit m-auto">
                <span class="relative z-10">الموحدة أقرب !</span>
                <img src="{{ asset('assets/image/blackBg.svg') }}" alt="black_svg" class="z-0 absolute w-[83%] left-[50%] translate-x-[-50%] top-[10%] h-full ">
                <span></span>
            </h1>                                
        </div>

        <!-- first Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-9 max-w-full w-full pb-6 sm:pb-0 m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
            <div class="rounded-[50%] h-16 w-16 sm:h-24 sm:w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">1</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[35%] md:w-[40%] lg:w-[44%]"></div>
        </div>
        <p class="text-[28px] md:text-[36px] lg:text-[45px] font-RpT-Bold text-[#FFFFFF]">القائمة العربية الموحدة
            <span class="text-[22px] md:text-[24px] lg:text-[36px] font-Flatnormal">
                هي الاقرب الى التأثير, حولت العرب الى قوة سياسية تشارك في صنع القرار, وتقدمت خطوه بعد خطوة بالأتجاه الصحيح لنكون لاعبا مركزيا زمؤثرا وحصلت خلال سنة واحدة ميزانيات وقرارت وخطط حكومية غير مسبوقة
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
        <p class="text-[28px] md:text-[36px] lg:text-[45px] font-RpT-Bold text-[#FFFFFF]">نبض الشارع العربي أقرب الى الموحدة,
            <span class="text-[22px] md:text-[24px] lg:text-[36px] font-Flatnormal">
                والنهج الواقعي الساعي للمشاركة المؤثرة والفاعلة, هو النهجج المتطابق مع اراء وهموم وتوجهات أغلب أبناء المجتمع العربي
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
        <p class="text-[28px] md:text-[36px] lg:text-[45px] font-RpT-Bold text-[#FFFFFF]">الموحده بأسلوبها العقلاني أقرب الى مواجهة العتصرية,
            <span class="text-[22px] md:text-[24px] lg:text-[36px] font-Flatnormal">
                من اي أسلوب شعبوي وصدامي أخر, فهو أسلوب يحرج العنصرين, الذين يريدوننا على الهامش, ويحعلنا نحقق انجازات تسد فعليا الفجوات والتمييز
            </span>
        </p>
        <!-- start with Form -->
        <div class="pt-52 flex flex-col items-center justify-start relative ">
            <div class="hidden xl:block absolute md:right-[14%] lg:right-[12%] top-[140px]">
                <div class="relative w-[650px] lg:w-[795px]">
                    <h3 class="text-white font-RpT-Bold md:text-[65px] lg:text-[96px] text-center z-10 relative">الموحدة أقرب اليك!</h1>
                        <img src="{{ asset('assets/image/smallBlackArea.svg') }}" alt="black_svg" class="z-0 absolute md:top-1 lg:top-4 lg:-right-2">
                </div>
            </div>
            <form class="pb-28 LandingPage">
                @csrf
                <div class="bg-[#FFD400] w-[95%] h-auto flex flex-col px-14 pb-8">
                    <p class=" mt-16 md:mt-28 text-[32px] sm:text-[44px]  md:text-[56px] font-RpT-Bold text-[#000000]">
                        للأنضمام الى كوادر الموحدة والمشاركة في تحقيق الأنتصار الانتخابي
                    </p>
                    <div class=" ltr pt-4 md:pt-10  lg:px-0">
                        <input type="text" name="name" placeholder="الاسم" class="rtl block w-full  md:h-[95px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-4 md:pt-10  lg:px-0">
                        <input type="text" name="city" placeholder="البلد" class="rtl block w-full md:h-[95px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-4 md:pt-10  lg:px-0">
                        <input type="number" name="phone" placeholder="هاتف" class="rtl block w-full md:h-[95px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                </div>
                <button type="submit" class="mt-9 bg-[#000000] text-white text-base sm:text-xl w-[95%]  md:h-[100px] py-4 font-[700] hover:bg-[#101426] duration-200">ارسال</button>
            </form>
        </div>
    </div>
</div>
@endsection
