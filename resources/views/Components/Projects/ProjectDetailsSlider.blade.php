<div class="relative mt-20 xl:mt-20 mb-10 lg:mb-0">
    <p class="font-FlatBold text-xl sm:text-[27px] text-center mt-8 lg:mt-0 xl:text-right">
        شاهد معنا
    </p>
    <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
</div>
<!--Starting Slider -->

<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style" id="association-news-slider-2">
    @if(!empty($news))
    @foreach ($news as $article)
    @php
    $img = 'storage/'.$article->image;
    @endphp
    <div class="p-3 item bg-white Card_shadow relative rounded-[5px] ">
        <div class="absolute leftline"></div>
        <div
            class="flex flex-row flex-wrap-reverse lg:flex-nowrap items-center lg:items-start justify-center gap-x-2 bg-[#E4FFE585] rounded-[5px]  py-2 px-2 ">
            <div class="relative">
            <img class=" lg:block max-w-[380px] lg:h-[280px]  max-h-[280px] object-cover rounded-[5px] my-1"
                src="{{ asset($img) }}" alt="people_on_Mousq" />
                <img src="{{ asset('assets/image/play_Svg.svg') }}" class="absolute max-w-[46px] top-[48%] left-[46%]" />
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>




