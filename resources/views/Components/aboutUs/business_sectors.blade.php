@php
  $business_sectors_main = nova_get_setting('main_section_text', 'default_value');
  @endphp

<div itemscope itemtype="https://schema.org/LocalBusiness" class="max-w-7xl mx-auto px-4 mt-16 lg:mt-32 sm:px-6 lg:px-8">
    <div class="relative mt-4 xl:mt-8">
        <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right">
            {{ $business_sectors_main }}
        </p>
        <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
    </div>
    <p itemprop="description" class="text-[#101426] font-noto_Regular text-base md:text-lg text-justify lg:text-right pt-9 max-w-3xl">
        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو
        شكل توضع الفقرات في الصفحة التي يقرأها.
    </p>
    <!-- first card -->
    @if(!empty($workplace))
        @foreach ($workplace as $oneworkplace)
    <div itemscope itemtype="https://schema.org/LocalBusiness" class="flex flex-col pt-16 lg:gap-y-28 gap-y-12 mb-12 lg:mb-32">
        <div class=" shaddow px-6 rounded-[16px]">
            <div class="flow-root rounded-lg bg-[#FFFFFF]  pb-8 ">
                <div class="-mt-6">
                    <img itemprop="image" src="{{ asset($oneworkplace['data']['image']) }}" alt="finance_Brand" class="w-16 h-16 mr-6">
                    <h3 itemprop="name" class="mt-8 text-lg font-FlatBold text-[#101426]">
                        {{ $oneworkplace['data']['title'] }}
                        </h3>
                    <p itemprop="description" class="mt-4 text-sm text-justify md:text-right md:text-[16px] font-noto_Regular text-[#6B7280] max-w-6xl">
                        {{ $oneworkplace['data']['sup_title']}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
