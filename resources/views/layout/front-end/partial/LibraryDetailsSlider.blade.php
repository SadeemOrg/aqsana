@php
         $books = [
            [
                'id' => '1',
                'name' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
                'description' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
                'file' => 'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
            ],
        
            [
                'id' => '2',
                'name' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
                'description' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
                'file' => 'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
            ],
        
            [
                'id' => '3',
                'name' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'cover_photo' => 'https://m.media-amazon.com/images/I/41ybG235TcL._AC_SY780_.jpg',
                'description' => 'The Alchemist is a novel by Brazilian author Paulo Coelho that was first published in 1988. Originally written in Portuguese, it became a widely translated international bestseller. An allegorical novel, The Alchemist follows a young Andalusian shepherd in his journey to the pyramids of Egypt, after having a recurring dream of finding a treasure there. ',
                'file' => 'https://www.pdfdrive.com/the-alchemist-a-fable-about-following-your-dreams-e1541016.html',
            ],
        ];
@endphp

<div class="relative mt-20 xl:mt-20 mb-10 lg:mb-0">
    <p class="font-FlatBold text-xl sm:text-[27px] text-center mt-8 lg:mt-0 xl:text-right">
       كتب ذات صلة
    </p>
    <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
</div>
<!--Starting Slider -->

<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style" id="association-news-slider-3">
    @if(!empty($books))
    @foreach ($books as $book)
    @php
    $img = $book['cover_photo'];
    @endphp
    <div class="p-3 item bg-white Card_shadow relative rounded-[5px] ">
        <div class="absolute leftline"></div>
        <div class="absolute leftline"></div>
        <div class="bg-[#E4FFE585] rounded-[5px] py-3 px-4 h-full w-full">
            <div class="">
                <img src="{{ asset($img) }}" alt="people_on_Mousq"
                    class="lg:w-[360px] w-full aspect-auto  sm:h-72 max-h-72 rounded-[5px]">
                <p class="text-[#349A37] text-[32px] pt-4 text-center max-w-none pl-4 ">
                    {{ Illuminate\Support\Str::limit($book['name'], 113) }}
                </p>
                <p
                    class="text-[20px] block sm:hidden md:block text-[#101426] font-noto_Regular pl-4 pt-2 text-center slider-paragraph">
                    {{ $book['author'] }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
