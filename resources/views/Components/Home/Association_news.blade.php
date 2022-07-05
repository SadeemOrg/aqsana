<style>
    .Card_shadow {
        box-shadow: 0px 0px 1px 0px #0000000A;
        box-shadow: 0px 2px 6px 0px #0000000A;
        box-shadow: 0px 16px 24px 0px #0000000F;
    }

    .leftline {
        /* content:"\A"; */
        width: 13px;
        height: 97.5%;
        background: #349A37;
        right: 10;
        /* display:inline-block; */
        margin: 0 -32px;
    }
</style>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:mt-24 mt-12 ">
    <div class="flex flex-row items-center justify-between mb-8 lg:mb-4 mx-4 lg:mx-none">
        <div class="relative">
            <h4 class="md:text-[18px] lg:text-[24px] xl:text-[30px] font-FlatBold text-[#101426]">
                أخبار الجمعية
            </h4>
            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
        </div>
        <div class="flex flex-row gap-x-2">
            <a href="/our-news/1/1" class="text-[#349A37] text-[16px] font-noto_Regular ">
                عرض المزيد
            </a>
            <svg class="mt-1.5" width="11" height="17" viewBox="0 0 11 17" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0.654799 8.49995C0.654799 8.19528 0.77113 7.89064 1.0033 7.65835L8.31299 0.34874C8.77798 -0.116247 9.53188 -0.116247 9.99668 0.34874C10.4615 0.813539 10.4615 1.56729 9.99668 2.03231L3.52866 8.49995L9.99645 14.9676C10.4612 15.4326 10.4612 16.1863 9.99645 16.6511C9.53165 17.1163 8.77775 17.1163 8.31277 16.6511L1.00308 9.34155C0.770867 9.10915 0.654799 8.80451 0.654799 8.49995Z"
                    fill="#349A37" />
            </svg>
        </div>
    </div>
    <!--Slider Content -->
    @include('layout.front-end.partial.Slider')
</div>
