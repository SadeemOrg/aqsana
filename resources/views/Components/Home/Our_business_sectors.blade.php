<style>
    .shaddow {
        box-shadow: 0px 10px 10px -5px #0000000A;
        box-shadow: 0px 20px 25px -5px #0000001A;
    }
</style>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 xl:mt-24">
    <div class="flex flex-row flex-wrap gap-y-8 md:gap-y-8 justify-center items-center gap-x-6">
        @if(is_array($partners)==true && !empty($partners))
        @foreach ($partners as $partner)
        @if (empty($partner['data']['link']))
        <img  src="{{ asset($partner['data']['image']) }}" alt="emar_deen" class="max-w-[140px] max-h-[135px]" />
        @else
        <img  src="{{ asset($partner['data']['image']) }}" alt="emar_deen" class="cursor-pointer max-w-[140px] max-h-[135px]"
             onclick="location.href='{{ $partner['data']['link'] }}'" />
        @endif
        @endforeach
        @endif
    </div>
    <div class="flex flex-col items-start justify-start mt-24">
        <div class="relative ">
            @php
            $text_main_workplace = nova_get_setting('text_main_workplace', 'default_value');
            $sub_text_workplace = nova_get_setting('sup_text_workplace', 'default_value');
            @endphp
            <p class="text-2xl text-[#101426] font-FlatBold">{{ $text_main_workplace }}</p>
            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
        </div>

        <p class="pt-7 text-lg text-[#101426] font-noto_Regular max-w-3xl">
            {{ $sub_text_workplace }}
        </p>
    </div>
    <div class="mt-12">
        <div class="grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
            <!-- first card -->
            @php
                // dd($sectors);
            @endphp

            @foreach ($sectors as $sector)
            @php
            $img = $sector->img;

            // dd($sector['data']['text_bottom_workplace_']);
            @endphp
            <div class="pt-6 shaddow relative pb-[72px] overflow-hidden rounded-[16px]">
                <div class="flow-root rounded-lg bg-[#FFFFFF] px-6 pb-8 ">
                    <!-- <div class=""> -->
                        <img src="{{ asset($img) }}" alt="Brand_icon" class="w-16 h-16">
                        <h3 class="mt-8 text-lg font-FlatBold text-[#101426]">{{ $sector->text
                            }}</h3>
                        <p class="mt-4 text-[16px] font-noto_Regular text-[#6B7280]">
                            {{Illuminate\Support\Str::limit($sector->sup_text,200) }}
                        </p>
                    <!-- </div> -->
                </div>
                @php
                $link = str_replace(" ", "-", $sector->id);

                @endphp
                <div
                    class="h-[72px] absolute bottom-0 right-0 left-0 w-full flex flex-row justify-between items-center px-6 cursor-pointer bg-[#F9FAFB]">
                    <a class="reltive link-wrap font-FlatBold text-[#349A37] text-base h-full w-full flex flex-row justify-between items-center"
                    onclick="location.href='{{ route('sector', ['id'=>$sector->id]) }}'">
                        <span class="relative z-10">عرض المزيد</span>
                        <svg class="relative z-10" width="11" height="17" viewBox="0 0 11 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.654768 8.49995C0.654769 8.19528 0.7711 7.89064 1.00327 7.65835L8.31296 0.34874C8.77795 -0.116247 9.53185 -0.116247 9.99665 0.34874C10.4614 0.813539 10.4614 1.56729 9.99665 2.03231L3.52863 8.49995L9.99642 14.9676C10.4612 15.4326 10.4612 16.1863 9.99642 16.651C9.53162 17.1163 8.77772 17.1163 8.31274 16.651L1.00305 9.34155C0.770836 9.10915 0.654768 8.80451 0.654768 8.49995Z"
                                fill="#349A37" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
