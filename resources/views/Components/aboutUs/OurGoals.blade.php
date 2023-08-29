<style>
    .newsShaddow:hover, .goal {
        box-shadow: 0px 16px 24px rgba(0, 0, 0, 0.06), 0px 2px 6px rgba(0, 0, 0, 0.04), 0px 0px 1px rgba(0, 0, 0, 0.04);
    }
</style>

<div  class="max-w-7xl mx-auto px-4 mt-12 sm:px-6 lg:px-8">
    <div class="relative mt-0">
        <p class="font-FlatBold text-3xl text-center xl:text-right"> اهدافنا </p>
        <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-7 hidden xl:block">
        </div>
    </div>
    <div class="pt-4 md:pt-14 grid grid-cols-1 lg:grid-cols-2 gap-y-3 md:gap-y-6 gap-x-6">
        <!--First section -->
        @if(!empty($goals))
        @foreach ($goals as $goal)
        <div  class="newsShaddow goal py-6  w-full text-[15px] sm:text-lg font-FlatBold text-right text-[#101426]   bg-white px-4">
            <div itemscope itemtype="https://schema.org/ItemList https://schema.org/CreativeWork" class="flex flex-row justify-between items-center goal-title cursor-pointer">
                <p itemprop="name" class="max-w-[91%] ">
                    {{ $goal->attributes->Goals_section_text }}
                </p>
                <svg class="arrow-icon duration-200" width="11" height="17" viewBox="0 0 11 17" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                d="M0.654771 8.49998C0.654771 8.19531 0.771103 7.89067 1.00328 7.65839L8.31297 0.348771C8.77795 -0.116216 9.53185 -0.116216 9.99665 0.348771C10.4614 0.81357 10.4614 1.56732 9.99665 2.03234L3.52863 8.49998L9.99642 14.9677C10.4612 15.4326 10.4612 16.1863 9.99642 16.6511C9.53162 17.1163 8.77773 17.1163 8.31274 16.6511L1.00305 9.34158C0.770839 9.10918 0.654771 8.80454 0.654771 8.49998Z"
                fill="#349A37" />
            </svg>
        </div>
        <div itemscope itemtype="https://schema.org/ItemList https://schema.org/CreativeWork" class="goal-text hidden">
            <p itemprop="name">
                {{ $goal->attributes->Goals_section_sup_text }}
            </p>
        </div>
    </div>
    @endforeach
    @endif
    </div>
</div>
