@php
  $aboutUs_main = nova_get_setting('main_section_text', 'default_value');
  $aboutUs_sub_text_Main = nova_get_setting('sup_text_main_aboutus', 'default_value');
  $main_section_image ='storage/'.nova_get_setting('main_section_image', 'default_value');
  $image_alt_main_section_about_us =  nova_get_setting('image_alt_main_section_about_us', 'default_value');
@endphp
<div class="bg-[#F2FFF285] py-10 mt-5">
    <div  class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div itemscope itemtype="https://schema.org/Organization" class="flex flex-row flex-wrap xl:flex-nowrap items-center justify-start sm:justify-center xl:items-start xl:justify-between gap-y-6 xl:gap-y-0 gap-x-7">
            <div itemscope itemtype="https://schema.org/Organization" class="flex flex-col  xl:basis-3/5 justify-center items-center xl:items-start">
                <div class="relative xl:mt-8">
                    <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right"> {{ $aboutUs_main }}</p>
                    <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-7 hidden xl:block"></div>
                </div>
                <img itemprop="image" src="{{ asset('assets/image/aboutUsComp.png') }}" alt="{{ $image_alt_main_section_about_us }}"
                class="block xl:hidden mt-12 object-cover" />
                <p itemprop="description"  class="max-w-2xl pt-9 font-noto_Regular text-base sm:text-lg text-justify md:text-right">
                    {!! $aboutUs_sub_text_Main !!}
                </p>
            </div>
            <img itemprop="image" src="{{ asset($main_section_image) }}" alt="{{ $image_alt_main_section_about_us }}" class="xl:basis-2/5 max-w-[550px] max-h-[460px] xl:block hidden" />
        </div>
    </div>
</div>

