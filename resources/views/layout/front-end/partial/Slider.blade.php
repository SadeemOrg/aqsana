<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style" id="association-news-slider">
    @if(!empty($news))
    @foreach ($news as $new )
    @php
    // dd($news);
    $img = 'storage/'.$new->image;
    @endphp
    <div class="p-3 item bg-white Card_shadow relative rounded-[5px] " onclick="location.href='our-project/1'">
        <div
            class="flex flex-row flex-wrap-reverse lg:flex-nowrap items-center lg:items-start justify-center gap-x-2 bg-[#E4FFE585] rounded-[5px]  py-2 px-2 ">
            <div class="flex flex-col justify-center lg:max-w-[160px] h-full ">
                <p class="text-[#349A37] text-[14px] pt-4 text-right lg:min-h-[90px]">
                    {{Illuminate\Support\Str::limit($new->title,100)  }}
                </p>
                <p class="text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2 ">أبريل 20, 2022</p>
                <p class="text-[#101426]  pt-2 text-xs font-noto_Regular ">
                    {{ Illuminate\Support\Str::limit($new->description,240) }}
                    @if(strip_tags(Str::length($new->description)) > 240)
                    <a href="#">
                        <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                    </a>
                    @endif
                </p>
            </div>
            <img class=" lg:block lg:max-w-[185px] h-[250px] sm:h-[350px] md:max-h-[320px] object-cover rounded-[5px] my-6"
            src="{{ asset($img) }}" alt="people_on_Mousq" />
        </div>
    </div>
@endforeach
@endif
</div>
