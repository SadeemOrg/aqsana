<style>
     .dashedBefore:before {
    content:"\A";
    width:13px;
    height:5px;
    background: #349A37;
    vertical-align: middle;
    position: absolute;
    top: 50px;
    right: -10px;
    margin:0 4px;
}
</style>

@php
  $aboutUs_main = 'storage/' .nova_get_setting('main_section_image_achievements', 'default_value');
  $aboutUs_sub_text_Main = nova_get_setting('sup_text_main_aboutus', 'default_value');
  $image_alt_main_section_about_us =  nova_get_setting('image_alt_main_section_about_us', $aboutUs_main?$aboutUs_main:"default_value");

@endphp
<div   class="max-w-7xl mx-auto px-4 pt-12 lg:pt-32 sm:px-6 lg:px-8">
    <div itemscope itemtype="https://schema.org/CreativeWork"
        class="flex flex-row flex-wrap xl:flex-nowrap items-center justify-start sm:justify-center  xl:items-start xl:justify-between gap-y-6 xl:gap-y-0 gap-x-7">
        <div class="flex flex-col  xl:basis-3/5 justify-center items-center xl:items-start">
            <div class="relative mt-4 xl:mt-8">
                <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right"> ابرز انجازاتنا</p>
                <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
            </div>
            <img itemprop="image" src="{{ asset($aboutUs_main) }}" alt="AlaqsaSun"
                class="block xl:hidden mt-12 object-cover" />
           @if(!empty($achievements))
           @foreach ($achievements as $achievement)
           <div class="relative  w-full">
           <div class="dashedBefore max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify sm:text-right text-[#101426]">
            <p class="mr-4">{{ $achievement->attributes->achievements_section_text }}</p>
            </div>
        </div>
            @endforeach
            @endif
        </div>
        <img itemprop="image" src="{{ asset($aboutUs_main) }}" alt="AlaqsaSun"
            class="xl:basis-2/5 max-w-[550px] max-h-[460px] xl:block hidden" />
    </div>
</div>
