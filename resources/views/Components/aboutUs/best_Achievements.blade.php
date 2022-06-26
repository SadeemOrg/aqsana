<style>
     .dashedBefore:before {
    content:"\A";
    width:13px;
    height:5px;
    background: #349A37;
    vertical-align: middle;
    display:inline-block;
    margin:0 4px;
}

</style>

@php
  $aboutUs_main = 'storage/' .nova_get_setting('main_section_image_achievements', 'default_value');
  $aboutUs_sub_text_Main = nova_get_setting('sup_text_main_aboutus', 'default_value');
@endphp
<div  class="max-w-7xl mx-auto px-4 pt-12 lg:pt-32 sm:px-6 lg:px-8">
    <div
        class="flex flex-row flex-wrap xl:flex-nowrap items-center justify-start sm:justify-center  xl:items-start xl:justify-between gap-y-6 xl:gap-y-0 gap-x-7">
        <div class="flex flex-col  xl:basis-3/5 justify-center items-center xl:items-start">
            <div class="relative mt-4 xl:mt-8">
                <p class="font-FlatBold text-3xl text-center xl:text-right"> ابرز انجازاتنا</p>
                <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
            </div>
            <img src="{{ asset($aboutUs_main) }}" alt="AlaqsaSun"
                class="block xl:hidden mt-12 object-cover" />
           @if(!empty($achievements))
           @foreach ($achievements as $achievement)
           <p class="dashedBefore max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify sm:text-right text-[#101426]">
            {{ $achievement->attributes->achievements_section_text }}
            </p>
            @endforeach
            @endif
            {{-- <p class="dashedBefore max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify sm:text-right text-[#101426]">
                ترميم وتأهيل المسجد الأقصى القديم وإعادة فتحه للصلاة في ايلول عام عام 1999 م.
            </p> --}}
            {{-- <p class="dashedBefore max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify sm:text-right text-[#101426] ">
                اتمام مشروع المسح الشامل لكافة المقدسات والأوقاف الإسلامية في أراضي الداخل الفلسطيني 1948.
            </p> --}}
            {{-- <p class="dashedBefore max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify sm:text-right text-[#101426] w-full ">
                إقامة مصلى في شارع عابر البلاد رقم 6.
            </p> --}}
        </div>
        <img src="{{ asset($aboutUs_main) }}" alt="AlaqsaSun"
            class="xl:basis-2/5 max-w-[550px] max-h-[460px] xl:block hidden" />
    </div>
</div>
