@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false ])
<div class="bg-green-700 min-h-full ">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 xl:pt-24 ">
        <div class="relative">
            <h3 class="text-white text-[186px] font-RpT-Bold text-center z-10 relative ">الموحدة أقرب !</h1>
                <img src="{{ asset('assets/image/blackBg.svg') }}" alt="black_svg" class="z-0 absolute right-[5%] top-14 ">
        </div>

        <!-- first Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-9 max-w-[250px] sm:max-w-[290px] md:max-w-full w-full m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[44%]"></div>
            <div class="rounded-[50%] h-24 w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">1</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[44%]"></div>
        </div>
        <p class="text-[42px] text-[#FFFFFF]">القائمة العربية الموحدة
            <span class="text-[36px] font-Flatnormal">
                هي الاقرب الى التأثير, حولت العرب الى قوة سياسية تشارك في صنع القرار, وتقدمت خطوه بعد خطوة بالأتجاه الصحيح لنكون لاعبا مركزيا زمؤثرا وحصلت خلال سنة واحدة ميزانيات وقرارت وخطط حكومية غير مسبوقة
            </span>
        </p>
        <!-- second Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-7 max-w-[250px] sm:max-w-[290px] md:max-w-full w-full m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[44%]"></div>
            <div class="rounded-[50%] h-24 w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">2</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[44%]"></div>
        </div>
        <p class="text-[42px] text-[#FFFFFF]">نبض الشارع العربي أقرب الى الموحدة,
            <span class="text-[36px] font-Flatnormal">
                والنهج الواقعي الساعي للمشاركة المؤثرة والفاعلة, هو النهجج المتطابق مع اراء وهموم وتوجهات أغلب أبناء المجتمع العربي
            </span>
        </p>

        <!-- third Paragraph -->
        <div class="flex flex-row justify-between items-center  pt-7 max-w-[250px] sm:max-w-[290px] md:max-w-full w-full m-auto">
            <div class="border-b-2 border-[#CDCCD2] w-[44%]"></div>
            <div class="rounded-[50%] h-24 w-24 bg-[#FFFFFF] flex flex-row items-center justify-center">
                <p class="text-[24px] text-[#009245]">3</p>
            </div>
            <div class="border-b-2 border-[#CDCCD2] w-[44%]"></div>
        </div>
        <p class="text-[42px] text-[#FFFFFF]">الموحده بأسلوبها العقلاني أقرب الى مواجهة العتصرية,
            <span class="text-[36px] font-Flatnormal">
                من اي أسلوب شعبوي وصدامي أخر, فهو أسلوب يحرج العنصرين, الذين يريدوننا على الهامش, ويحعلنا نحقق انجازات تسد فعليا الفجوات والتمييز
            </span>
        </p>
        <!-- start with Form -->
        <div class="pt-52 flex flex-col items-center justify-start relative ">
            <div class="absolute top-[150px]">
                <div class="relative w-[795px]">
                    <h3 class="text-white text-[88px] font-FlatBold text-center z-10 relative">الموحدة أقرب اليك!</h1>
                        <img src="{{ asset('assets/image/smallBlackArea.svg') }}" alt="black_svg" class="z-0 absolute top-0 ">
                </div>
            </div>
            <form class="pb-28">
                <div class="bg-[#FFD400] w-[95%] h-auto flex flex-col px-14 pb-8">
                    <p class=" mt-28 text-[50px] text-[#000000]">
                        للأنضمام الى كوادر الموحدة والمشاركة في تحقيق الأنتصار الانتخابي
                    </p>
                    <div class=" ltr pt-10 px-6 lg:px-0">
                        <input type="text" name="name" placeholder="الاسم" class="rtl block w-full h-[95px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-10 px-6 lg:px-0">
                        <input type="text" name="name" placeholder="البلد" class="rtl block w-full h-[95px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-10 px-6 lg:px-0">
                        <input type="text" name="name" placeholder="هاتف" class="rtl block w-full h-[95px]  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                </div>
                <button class="mt-9 bg-[#000000] text-white text-base sm:text-xl w-[100px] sm:w-[150px] md:w-[95%] h-[100px] py-4 font-[700] hover:bg-[#101426] duration-200">ارسال</button>
            </form>
        </div>
    </div>
</div>