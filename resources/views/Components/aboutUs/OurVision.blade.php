<style>
    .shaddow {
        box-shadow: 0px 10px 10px -5px #0000000A;
        box-shadow: 0px 20px 25px -5px #0000001A;
    }
</style>

@php
  $vision_main = nova_get_setting('vision_section_text', 'default_value');
  $vision_sub_text_Main = nova_get_setting('sup_text_vision_aboutus', 'default_value');
  $vision_section_image ='storage/'.nova_get_setting('vision_section_image', 'default_value');
//   @dd($vision_main)
@endphp
<div  class="max-w-7xl mx-auto px-4 mt-8 md:mt-24 sm:px-6 lg:px-8">
    <div
        class="flex flex-row flex-wrap xl:flex-nowrap items-center justify-start sm:justify-center xl:items-start xl:justify-between gap-y-6 xl:gap-y-0 gap-x-7">
        <img src="{{ asset($vision_section_image) }}" alt="AlAqsaView"
            class="xl:basis-2/5 max-w-[550px] max-h-[460px] xl:block hidden" />
        <div class="flex flex-col xl:basis-3/5 xl:mt-24 mt-4 justify-center items-center xl:items-start h-full">
            <div class="relative">
                <p class="font-FlatBold text-3xl text-center xl:text-right"> {{ $vision_main }}</p>
                <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-7 hidden xl:block"></div>
            </div>
                  <img src="{{ asset('assets/image/AlAqsaView.png') }}" alt="AlAqsaView"
                class="block xl:hidden mt-12 object-cover" />
            <p class="max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify md:text-right">
                {{ $vision_sub_text_Main }}
                {{-- تسعى جمعية الأقصى إلى غرس محبة القدس والمسجد الأقصى المبارك في قلب كل بيت من بيوت المسلمين وإعمارهما
                وتكثيف شد الرحال إليهم ورفع الوعي للمخاطر المحدقة بهم ودعم وتمكين أهالي بيت المقدس. كما وتسعى لتكون
                العنوان الأول والمرجع المهني لحماية ورعاية وصيانة الأوقاف والمقدسات، والتواصل مع قرانا ومدننا المهجرة
                والقائمة والمهددة بالاقتلاع تثبيتا للحق والوجود والصمود لتبقى شاهدة على وقفية هذه الأرض المباركة. --}}
            </p>
        </div>
           {{-- <img src="{{ asset('assets/image/AlAqsaView.png') }}" alt="AlAqsaView"
                class="block xl:hidden mt-12 object-cover" /> --}}
    </div>
</div>
