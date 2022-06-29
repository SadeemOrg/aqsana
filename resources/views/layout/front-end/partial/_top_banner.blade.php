<div class="owl-carousel" id="main-home-slider">
    @if(!empty($Heros))
    @foreach ( $Heros as $Hero )
    <img class="h-[220px] md:h-[500px]" src="{{ URL::asset($Hero['data']['image'])}}" alt="topBanner">
    @endforeach
    @endif
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-row flex-wrap lg:flex-nowrap mt-16 items-center justify-center lg:justify-start  gap-x-5">
        @if(!empty($lastnews))
        @foreach ($lastnews as $lastnew )
        @php
        $img = 'storage/'.$lastnew->image;
        $id = $lastnew->id
        @endphp
        <div class="p-3 rounded-[5px] common-shadow mb-6 xl:mb-0" onclick="location.href='{{ route('getnewDetail', ['id' => $lastnew->id]) }}'">
            <div class=" md:h-[380px] md:max-w-[590px] lg:min-w-[570px] bg-[#E4FFE585] rounded-[5px] py-5 px-4">
                <img src="{{ asset($img) }}" alt="people_on_Mousq" class="w-full h-[254px] object-cover rounded-[5px]">
                <div class="pr-6">
                <p class="text-[#349A37]  pt-4 text-right  font-bold text-lg  pl-2 ">{{Illuminate\Support\Str::limit($lastnew->title,35)  }}
               <span class="text-black"> {{  Illuminate\Support\Str::limit($lastnew->description,78)  }}</span>
                </p>
            </div>
        </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
