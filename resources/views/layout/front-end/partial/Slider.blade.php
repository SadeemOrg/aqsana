<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style" id="association-news-slider">
    @if (!empty($news))
        @foreach ($news as $new)
            @php
                // dd($news);
                $img = 'storage/' . $new->image;
                $route_title = str_replace(' ', '-', $new->title);
            @endphp
            <div class="w-[4oopx] h-[310px] sm:h-[300px] Card_shadow bg-transparent p-3">
                <div class="absolute leftline"></div>
                <div
                    class="bg-[#E4FFE585] w-full h-full flex flex-col sm:flex-col justify-start items-start gap-x-3 w-full">
                    <div class="flex flex-row items-start justify-start">
                        <!--Add New Title with Image Ameed-->
                        <div class="flex flex-row items-center h-full w-full  basis-[50%] md:basis-[40%] ">
                            <p class="block text-[#349A37] text-[14px] pt-2 sm:pt-4 text-right cursor-pointer"
                                onclick="location.href='{{ route('getnewDetail', ['title' => $route_title, 'id' => $new->id]) }}'">
                                {{ Illuminate\Support\Str::limit($new->title, 100) }}
                            </p>
                        </div>
                        <div
                            class="flex xl:max-w-[184px] md:w-[184px] max-h-[175px] h-[175px] basis-[50%] md:basis-[60%]  px-2 py-4">
                            <img src="{{ asset($img) }}" alt="people_on_Mousq"
                                class="rounded-[10px] object-cover h-full w-[184px]  " />
                        </div>
                        <!--End Add Title with Image Ameed-->
                    </div>
                    <!--Start Paragraph -->
                    @if (!empty($new->new_date))
                        <p class="block text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2 ">
                            {{ $new->new_date }}
                        </p>
                    @endif
                    <p class="text-[#101426]  pt-2 text-xs font-noto_Regular ">
                        {{ Illuminate\Support\Str::limit($new->description, 156) }}
                        @if (strip_tags(Str::length($new->description)) > 156)
                            <a href="{{ route('getnewDetail', ['title' => $route_title, 'id' => $new->id]) }}">
                                <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                            </a>
                        @endif
                    </p>
                    <!--End Satrt Paragraph -->
                </div>
            </div>
        @endforeach
    @endif
</div>
