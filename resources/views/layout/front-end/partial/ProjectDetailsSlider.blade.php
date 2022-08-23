<style>
    .cardShadow1 {
        box-shadow: 0px 0px 1px 0px #0000000A;

        box-shadow: 0px 2px 6px 0px #0000000A;

        box-shadow: 0px 16px 24px 0px #0000000F;

    }
</style>

<div class="relative mt-20 xl:mt-20 mb-10 lg:mb-0">
    <p class="font-FlatBold text-xl sm:text-[27px] text-center mt-8 lg:mt-0 xl:text-right">
        مقالات ذات صلة
    </p>
    <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
</div>
<!--Starting Slider -->

<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style" id="association-news-slider-2">
    @if(!empty($Articles))
    @foreach ($Articles as $article)
    @php
    $img = 'storage/'.$article->image;
    @endphp
    <div class="p-3 item bg-white Card_shadow relative rounded-[5px]">
        <div class="absolute leftline"></div>
        <div class="cardShadow1">
            <div
                class="flex sm:hidden md:flex xl:flex-row flex-col relative xl:max-w-sm md:w-full items-start bg-[#E4FFE585] gap-y-2 rounded-[5px] py-6 px-2 lg:h-[333px] xl:h-48  overflow-hidden">
                <!--news text more than xl screen -->
                <div class="hidden xl:flex flex-col items-start justify-start w-44  px-2 ">
                    <p class="text-[#349A37] text-[12px] text-right ">
                        {{Illuminate\Support\Str::limit($article->title,52) }}
                    </p>
                    @if(!empty($article->new_date))
                    <p class="text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2">{{ $article->new_date }}</p>
                    @else
                    <p class="text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2">01-02-1234</p>
                    @endif
                    <p class="text-xs text-[#101426] font-noto_Regular pt-2 slider-paragraph">
                        {!! Illuminate\Support\Str::limit($article->description,35)!!}
                        @if(strip_tags(Str::length($article->description)) > 35)
                        <a href="#">
                            <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                        </a>
                        @endif
                    </p>
                </div>
                <img class=" xl:max-w-[192px] max-w-full xl:h-36 md:h-[221px] iphone13:h-[230px] h-[160px] rounded-[5px] "
                    src="{{ asset($img) }}" alt="people_on_Mousq" />
                <!--news text until md screen -->
                <div
                    class="xl:hidden md:h-[84px] lg:h-auto flex flex-col items-center justify-center w-full overflow-y-hidden">
                    <p class="mx-4 text-[#349A37] text-center text-[12px]  ">
                        {{Illuminate\Support\Str::limit($article->title,72) }}
                    </p>
                    @if(!empty($article->new_date))
                    <p
                        class="xl:hidden md:flex sm:hidden flex text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2">
                        {{ $article->new_date }}</p>
                    @else
                    <p
                        class="xl:hidden md:flex  sm:hidden flex text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2">
                        01-02-1234</p>
                    @endif
                    <p
                        class="lg:hidden md:flex sm:hidden flex text-xs text-[#101426] font-noto_Regular pt-2 slider-paragraph">
                        {!! Illuminate\Support\Str::limit($article->description,35)!!}
                        @if(strip_tags(Str::length($article->description)) > 35)
                        <a href="#">
                            <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                        </a>
                        @endif
                    </p>
                </div>
            </div>
            <!--only for md screen -->
            <div class="hidden sm:flex md:hidden flex-col items-center justify-center relative">
                <img class="Iman h-96" src="{{ asset($img) }}" alt="people_on_Mousq">
                <div
                    class="writing sm:block absolute hidden top-[75%] right-6 left-6 max-h-14 text-center overflow-hidden ">
                    <p itemprop="title"
                        class="text-white bg-[#349A37] text-right font-bold text-sm sm:text-lg rounded-md px-2">
                        {{Illuminate\Support\Str::limit($article->title,72) }}
                        <span itemprop="description" class="text-white">
                            {!! Illuminate\Support\Str::limit($article->description,35)!!}
                            @if(strip_tags(Str::length($article->description)) > 35)
                            <a href="#">
                                <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                            </a>
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
