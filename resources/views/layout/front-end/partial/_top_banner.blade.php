<div  itemscope class="owl-carousel dots-style1" id="main-home-slider">
    @if(is_array($Heros)==true && !empty($Heros))
    @foreach ( $Heros as $Hero )
    <img itemprop="image"  alt="Google" class="h-[150px] sm:h-[220px]  lg:h-[500px]" src="{{ URL::asset($Hero['data']['image'])}}" alt="topBanner">
    @endforeach
    @endif
</div>
<div itemscope class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

@include('Components.Home.Search')

    <div class="flex flex-row flex-wrap lg:flex-nowrap mt-16 items-center justify-center xl:justify-start gap-x-5">
        @if(!empty($lastnews))
        @foreach ($lastnews as $lastnew )
        @php
        $img = 'storage/'.$lastnew->image;
        $id = $lastnew->id
        @endphp
        <div class="p-3 rounded-[5px] common-shadow mb-6 xl:mb-0 hover:cursor-pointer" onclick="location.href='{{ route('getnewDetail', ['id' => $lastnew->id]) }}'">
            <div class=" md:max-h-[390px] sm:max-w-[700px] bg-[#E4FFE585] rounded-[5px] py-5 px-4">
                <img itemprop="image"  alt="Google" src="{{ asset($img) }}" alt="people_on_Mousq" class="w-full h-[254px] object-fill rounded-[5px]">
                <div class="pr-6">
                <p  itemprop="title" class="text-[#349A37] pt-4 text-right font-bold text-lg pl-2 ">{{Illuminate\Support\Str::limit($lastnew->title,55)  }}
               <span  itemprop="description" class="text-black"> {{  Illuminate\Support\Str::limit($lastnew->description,55)  }}</span>
                </p>
            </div>
        </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
