<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style mt-6" id="association-news-slider">
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

            <!-- display image medium screen div -->
            {{-- <div class="block sm:hidden px-3 pt-4 w-full ">
                <img src="{{ asset($img) }}" alt="people_on_Mousq" class=" rounded-[5px] object-cover h-[247px]" />
            </div> --}}

            <!-- start right div -->
            {{-- <div class="flex flex-col items-start sm:max-w-[250px] md:max-w-[170px] pr-3">
                <p class="hidden sm:block text-[#349A37] text-[14px] pt-2 sm:pt-4 text-right cursor-pointer"
                    onclick="location.href='{{ route('getnewDetail', ['title'=>$route_title,'id' => $new->id]) }}'">
                    {{Illuminate\Support\Str::limit($new->title,100) }}
                </p>
                <p class="block sm:hidden text-[#349A37] text-[14px] pt-2 sm:pt-4 text-right cursor-pointer"
                    onclick="location.href='{{ route('getnewDetail', ['title'=>$route_title,'id' => $new->id]) }}'">
                    {{Illuminate\Support\Str::limit($new->title,75) }}
                </p>

                @if (!empty($new->new_date))
                <p class="hidden sm:block text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2 ">
                    {{ $new->new_date }}
                </p>
                @endif
                <p class="text-[#101426]  pt-2 text-xs font-noto_Regular ">
                    {{ Illuminate\Support\Str::limit($new->description,156) }}
                    @if (strip_tags(Str::length($new->description)) > 156)
                    <a href="{{ route('getnewDetail', ['title'=>$route_title,'id' => $new->id]) }}">
                        <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                    </a>
                    @endif
                </p>
            </div> --}}
            <!-- display image div -->
            {{-- <div class="hidden sm:block h-full w-full px-2 py-4">
                <img src="{{ asset($img) }}" alt="people_on_Mousq" class="rounded-[10px] object-cover h-full " />
            </div> --}}
            {{-- </div> --}}
            {{-- <div class="p-3 item bg-white Card_shadow relative rounded-[5px] "
        onclick="location.href='{{ route('getnewDetail', ['title'=>$new->title,'id' => $new->id]) }}'">
        <div
            class="flex flex-row flex-wrap-reverse lg:flex-nowrap items-center lg:items-start justify-center gap-x-2 bg-[#E4FFE585] rounded-[5px]  py-2 px-2 max-h-[390px]">
            <div class="flex flex-col justify-center lg:max-w-[160px] max-h-[380px] ">
                <p class="text-[#349A37] text-[14px] pt-4 text-right lg:min-h-[90px]">
                    {{Illuminate\Support\Str::limit($new->title,100) }}
                </p>
                <p class="text-xs text-[#8F9BB3] font-noto_Regular text-right pt-2 ">أبريل 20, 2022</p>
                <p class="text-[#101426]  pt-2 text-xs font-noto_Regular ">
                    {{ Illuminate\Support\Str::limit($new->description,240) }}
                    @if (strip_tags(Str::length($new->description)) > 240)
                    <a href="#">
                        <span class="text-[#349A37] text-[12px]">عرض المزيد</span>
                    </a>
                    @endif
                </p>
            </div>
            <img class=" lg:max-w-[185px] h-[250px] sm:h-[350px] md:h-[320px] object-cover rounded-[5px] my-6"
                src="{{ asset($img) }}" alt="people_on_Mousq" />
        </div>
    </div> --}}
        @endforeach
    @endif
</div>
