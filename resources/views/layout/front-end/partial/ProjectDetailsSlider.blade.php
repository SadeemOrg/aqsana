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
    <div class="p-3 item bg-white Card_shadow relative rounded-[5px] ">
        <div class="absolute leftline"></div>
        <div
            class="flex flex-row flex-wrap-reverse lg:flex-nowrap items-center lg:items-start justify-center gap-x-2 bg-[#E4FFE585] rounded-[5px]  py-2 px-2 ">
            <div class="flex flex-col lg:max-w-[160px] ">
                <p class="text-[#349A37] text-[14px] pt-4 text-right lg:min-h-[90px] cursor-pointer"
                onclick="location.href='{{ route('getnewDetail', ['title'=>$article->title,'id' => $article->id]) }}'"
                >
                    {{Illuminate\Support\Str::limit($article->title,100) }}
                </p>
                <p class="text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2 ">أبريل 20, 2022</p>
                <p class="text-xs text-[#101426] font-noto_Regular pt-2 slider-paragraph">
                    {!! Illuminate\Support\Str::limit($article->description,240)!!}
                    @if(strip_tags(Str::length($article->description)) > 240)
                    <a href="#">
                        <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                    </a>
                    @endif
                </p>
            </div>
            <img class=" lg:block lg:max-w-[185px] h-[250px] sm:h-[350px] md:max-h-[320px] object-cover rounded-[5px] my-6 cursor-pointer"
                src="{{ asset($img) }}" alt="people_on_Mousq"
                 onclick="location.href='{{ route('getnewDetail', ['title'=>$article->title,'id' => $article->id]) }}'"
                 />
        </div>
    </div>
    @endforeach
    @endif
</div>
