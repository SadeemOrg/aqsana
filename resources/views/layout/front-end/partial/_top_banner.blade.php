<style>
    .Iman {
        background: linear-gradient(0.92deg, rgba(0, 0, 0, 0.3) 4.13%, rgba(0, 0, 0, 0) 96.18%);
    }
</style>
<div itemscope class="owl-carousel dots-style1" id="main-home-slider">
    @if(is_array($Heros)==true && !empty($Heros))
    @foreach ( $Heros as $Hero )
    <img itemprop="image" alt="Google" class="h-[250px] sm:h-[350px]  lg:h-[680px]"
        src="{{ URL::asset($Hero['data']['image'])}}" alt="topBanner">
    @endforeach
    @endif
</div>
<div itemscope class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

    {{-- @include('Components.Home.Search') --}}

    <div class="flex flex-row flex-wrap lg:flex-nowrap mt-16 items-center justify-center xl:justify-start gap-x-5">
        @if(!empty($lastnews))
        @foreach ($lastnews as $lastnew )
        @php
        $img = 'storage/'.$lastnew->image;
        $id = $lastnew->id;
        $route_title = str_replace(" ", "-", $lastnew->title);
        @endphp
        <div class="p-3 rounded-[5px] common-shadow mb-6 xl:mb-0 hover:cursor-pointer relative"
            onclick="location.href='{{ route('getnewDetail', ['title'=>$route_title,'id' => $lastnew->id]) }}'">
            <div class="relative  bg-[#E4FFE585] rounded-[5px] py-5 px-4">
                <img itemprop="image" alt="Google" src="{{ asset($img) }}" alt="people_on_Mousq"
                    class="Iman md:h-[375px] sm:w-[563px] object-fill rounded-[5px]">
                <div class="writing sm:block absolute hidden top-[75%] right-6 left-6 max-h-14 text-center overflow-hidden ">
                    <p itemprop="title"
                        class="text-white bg-[#349A37] text-right font-bold text-sm sm:text-lg rounded-md px-2">
                        {{Illuminate\Support\Str::limit($lastnew->title,53) }}

                        <span itemprop="description" class="text-white">
                            {{Illuminate\Support\Str::limit($lastnew->description,49) }}</span>
                    </p>
                </div>
                <!-- hidden div Bar -->
                <div class="writing relative sm:hidden  mt-4 pr-6 ">
                    <p itemprop="title" class="text-[#349A37] pt-4 text-right font-bold text-sm pl-2 ">
                        {{Illuminate\Support\Str::limit($lastnew->title,55) }}
                        <span itemprop="description" class="text-black">
                            {{Illuminate\Support\Str::limit($lastnew->description,45) }}</span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
