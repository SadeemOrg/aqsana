@php
            $text_main_workplace = nova_get_setting('text_main_workplace', 'default_value');
            $sub_text_workplace = nova_get_setting('sup_text_workplace', 'default_value');
            // $workplace= nova_get_setting('workplace', 'default_value');
            // dd($workplace[0]['data']["main_img_workplace"]);
            @endphp

<div itemscope itemtype="https://schema.org/LocalBusiness" class="max-w-7xl mx-auto px-4 mt-16 lg:mt-32 sm:px-6 lg:px-8">
    <div class="relative mt-4 xl:mt-8">
        <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right">
            {{ $text_main_workplace }}
        </p>
        <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
    </div>
    <p itemprop="description"
        class="text-[#101426] font-noto_Regular text-base md:text-lg text-justify lg:text-right pt-9 max-w-3xl">
        {{ $sub_text_workplace }}
    </p>
    <!-- first card -->


        @foreach ($sectors as $sector)
            <div itemscope itemtype="https://schema.org/LocalBusiness"
                class="flex flex-col pt-16 lg:gap-y-28 gap-y-12 mb-12 lg:mb-32">
                <div class=" shaddow px-6 rounded-[16px]">
                    <div class="flow-root rounded-lg bg-[#FFFFFF]  pb-8 ">
                        <div class="-mt-6">
                            @php
                            $img ='storage/' . $sector->img;

                            // dd($sector['data']['text_bottom_workplace_']);
                            @endphp
                            <img itemprop="image" src="{{ asset($img) }}" alt="finance_Brand"
                                class="w-16 h-16 mr-6">
                            <h3 itemprop="name" class="mt-8 text-lg font-FlatBold text-[#101426]">
                                {{ $sector->text }}
                            </h3>
                            <p itemprop="description"
                                class="mt-4 text-sm text-justify md:text-right md:text-[16px] font-noto_Regular text-[#6B7280] max-w-6xl">
                             {{ $sector->sup_text }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

</div>
