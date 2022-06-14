@extends('layout.app')
@section('content')
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

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2">
    <div class="flex flex-row">
        <ul class="list-reset breadcrumbs flex flex-row font-FlatBold ">
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-xs sm:text-[14px] text-[#101426]">
                <a href="/">الرئيسية</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-xs sm:text-[14px] text-[#101426]">
                <a href="/our-project">أخبارنا</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-xs sm:text-[14px]  text-[#349A37]">
                أكثر من 10 آلاف مشارك بمعسكر “القدس أولًا 13” الذي نظمته الحركة الإسلامية وجمعية الأقصى
            </li>
        </ul>
    </div>
</div>

<div class="bg-[#F2FFF285] py-16 pb-20 mt-10">
    <div class="max-w-7xl mx-auto px-4  sm:px-6 lg:px-8">
        <div class="relative ">
            <p class="font-FlatBold text-xl sm:text-3xl text-center mt-8 lg:mt-0 xl:text-right">
                أكثر من 10 آلاف مشارك بمعسكر “القدس أولًا 13” الذي نظمته الحركة الإسلامية وجمعية الأقصى
            </p>
            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
        </div>
        <div class="p-3 bg-white Card_shadow mt-4 lg:mt-16 relative flex flex-col items-center justify-center w-full" >
            <div class="absolute leftline"></div>
            <div class="max-w-6xl bg-[#E4FFE585] rounded-[5px] py-3 px-4 ">
                <img src="{{ asset('assets/image/Alquds_First.png') }}" alt="people_on_Mousq"
                    class="w-full max-h-[510px]">
                <p class="text-[#349A37] text-[22px] pt-4 text-right px-4">
                    أكثر من 10 آلاف مشارك بمعسكر “القدس أولًا 13” الذي نظمته الحركة الإسلامية وجمعية الأقصى

                </p>
                <p class="text-sm text-[#8F9BB3] font-noto_Regular text-right pt-2 px-4">أبريل 20, 2022</p>
                <p class="text-sm text-[#8F9BB3] font-noto_Regular text-right pt-2 px-4">
                    أخبار الجمعية, أخبار وتقارير, أخبارنا, القدس والمسجد الأقصى, مشاريع الجمعية, مشاريع جمعية الأقصى,
                    مشاريعنا
                </p>
                <p class="text-base text-[#101426] font-noto_Regular px-4 pt-2">
                    نظّمت، اليوم السبت، الحركة الإسلامية في الداخل الفلسطيني وجمعية الأقصى لرعاية الأوقاف والمقدسات،
                    للسنة
                    الثالثة عشرة على التوالي، معسكر القدس أولًا الذي يهدف إلى تهيئة وتجهيز المسجد الأقصى المبارك
                    لاستقبال
                    المصلين في شهر رمضان المبارك، ولدعم...
                </p>
                <div class="flex flex-row items-center justify-start px-4 pt-4 pb-10 font-noto_Regular gap-x-2">
                    <p class="text-[#101426] text-sm">شارك عبر</p>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12.1687" cy="12.1687" r="11.6687" stroke="#101426" />
                        <g clip-path="url(#clip0_38_2337)">
                            <path
                                d="M12.9284 19.0464V13.0135H14.9526L15.2563 10.6616H12.9284V9.16032C12.9284 8.47962 13.1167 8.01573 14.0939 8.01573L15.3382 8.01522V5.91166C15.1231 5.88369 14.3844 5.81958 13.5246 5.81958C11.7294 5.81958 10.5003 6.9154 10.5003 8.92739V10.6616H8.46997V13.0135H10.5003V19.0464H12.9284Z"
                                fill="#101426" />
                        </g>
                        <defs>
                            <clipPath id="clip0_38_2337">
                                <rect width="13.2268" height="13.2268" fill="white"
                                    transform="translate(5.29077 5.81958)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12.1687" cy="12.1687" r="11.6687" stroke="#101426" />
                        <g clip-path="url(#clip0_38_2342)">
                            <path
                                d="M18.5173 8.33182C18.0255 8.54759 17.5013 8.6906 16.9549 8.76004C17.5171 8.42441 17.9461 7.89699 18.1478 7.26128C17.6237 7.57376 17.045 7.79448 16.4283 7.91766C15.9307 7.38776 15.2214 7.05957 14.4476 7.05957C12.9464 7.05957 11.7378 8.27809 11.7378 9.77189C11.7378 9.98683 11.756 10.1935 11.8006 10.3902C9.54625 10.2803 7.55148 9.19983 6.21144 7.55392C5.97749 7.95982 5.84027 8.42441 5.84027 8.92455C5.84027 9.86365 6.32387 10.6961 7.04473 11.1781C6.60907 11.1698 6.18168 11.0433 5.8196 10.8441C5.8196 10.8524 5.8196 10.8631 5.8196 10.8738C5.8196 12.1916 6.75953 13.2861 7.9921 13.5382C7.77138 13.5986 7.53082 13.6275 7.28116 13.6275C7.10756 13.6275 6.9323 13.6176 6.7678 13.5812C7.11913 14.6551 8.1161 15.4445 9.30155 15.4702C8.37899 16.1918 7.20759 16.6267 5.93947 16.6267C5.71709 16.6267 5.50381 16.6168 5.29053 16.5895C6.49169 17.3641 7.91522 17.8063 9.45036 17.8063C14.4402 17.8063 17.1682 13.673 17.1682 10.0902C17.1682 9.97029 17.1641 9.85456 17.1583 9.73965C17.6964 9.35773 18.1486 8.88074 18.5173 8.33182Z"
                                fill="#101426" />
                        </g>
                        <defs>
                            <clipPath id="clip0_38_2342">
                                <rect width="13.2268" height="13.2268" fill="white"
                                    transform="translate(5.29053 5.81958)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12.1687" cy="12.1687" r="11.6687" stroke="#101426" />
                        <path
                            d="M12.7948 6C9.16884 6 7.24048 8.32362 7.24048 10.8573C7.24048 12.0323 7.89705 13.4976 8.94805 13.9623C9.10765 14.0343 9.19447 14.0037 9.23003 13.8557C9.26145 13.7432 9.39955 13.2016 9.46653 12.9461C9.4872 12.8642 9.47645 12.7931 9.4103 12.7162C9.06134 12.3126 8.78432 11.5775 8.78432 10.8879C8.78432 9.12077 10.1892 7.40492 12.5799 7.40492C14.6471 7.40492 16.0934 8.74783 16.0934 10.6687C16.0934 12.8394 14.9448 14.3411 13.4522 14.3411C12.6262 14.3411 12.0109 13.6928 12.2061 12.8907C12.4418 11.9356 12.904 10.9086 12.904 10.2197C12.904 9.60203 12.555 9.091 11.8422 9.091C11.0013 9.091 10.3191 9.9237 10.3191 11.0417C10.3191 11.752 10.5705 12.2316 10.5705 12.2316C10.5705 12.2316 9.73858 15.5922 9.58395 16.2198C9.32264 17.2824 9.6195 19.0032 9.64514 19.1512C9.66085 19.2331 9.75264 19.2587 9.80391 19.1917C9.88577 19.0842 10.8913 17.6495 11.1733 16.6126C11.2758 16.2347 11.6967 14.7024 11.6967 14.7024C11.9737 15.2027 12.7733 15.6219 13.6251 15.6219C16.1587 15.6219 17.9895 13.3951 17.9895 10.6315C17.9804 7.98211 15.713 6 12.7948 6Z"
                            fill="#101426" />
                    </svg>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12.1687" cy="12.1687" r="11.6687" stroke="#101426" />
                        <path
                            d="M12.7948 6C9.16884 6 7.24048 8.32362 7.24048 10.8573C7.24048 12.0323 7.89705 13.4976 8.94805 13.9623C9.10765 14.0343 9.19447 14.0037 9.23003 13.8557C9.26145 13.7432 9.39955 13.2016 9.46653 12.9461C9.4872 12.8642 9.47645 12.7931 9.4103 12.7162C9.06134 12.3126 8.78432 11.5775 8.78432 10.8879C8.78432 9.12077 10.1892 7.40492 12.5799 7.40492C14.6471 7.40492 16.0934 8.74783 16.0934 10.6687C16.0934 12.8394 14.9448 14.3411 13.4522 14.3411C12.6262 14.3411 12.0109 13.6928 12.2061 12.8907C12.4418 11.9356 12.904 10.9086 12.904 10.2197C12.904 9.60203 12.555 9.091 11.8422 9.091C11.0013 9.091 10.3191 9.9237 10.3191 11.0417C10.3191 11.752 10.5705 12.2316 10.5705 12.2316C10.5705 12.2316 9.73858 15.5922 9.58395 16.2198C9.32264 17.2824 9.6195 19.0032 9.64514 19.1512C9.66085 19.2331 9.75264 19.2587 9.80391 19.1917C9.88577 19.0842 10.8913 17.6495 11.1733 16.6126C11.2758 16.2347 11.6967 14.7024 11.6967 14.7024C11.9737 15.2027 12.7733 15.6219 13.6251 15.6219C16.1587 15.6219 17.9895 13.3951 17.9895 10.6315C17.9804 7.98211 15.713 6 12.7948 6Z"
                            fill="#101426" />
                    </svg>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12.1687" cy="12.1687" r="11.6687" stroke="#101426" />
                        <path
                            d="M17.907 17.907V14.0306C17.907 12.1255 17.4969 10.6702 15.2743 10.6702C14.2026 10.6702 13.4882 11.2523 13.1972 11.8079H13.1707V10.8422H11.0671V17.907H13.2633V14.401C13.2633 13.4749 13.4353 12.5885 14.5731 12.5885C15.6976 12.5885 15.7109 13.6337 15.7109 14.4539V17.8937H17.907V17.907Z"
                            fill="#101426" />
                        <path d="M7.49487 10.8422H9.69105V17.907H7.49487V10.8422Z" fill="#101426" />
                        <path
                            d="M8.59308 7.323C7.89189 7.323 7.323 7.89189 7.323 8.59308C7.323 9.29427 7.89189 9.87639 8.59308 9.87639C9.29427 9.87639 9.86316 9.29427 9.86316 8.59308C9.86316 7.89189 9.29427 7.323 8.59308 7.323Z"
                            fill="#101426" />
                    </svg>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="col-span-1">
                        <img class="m-auto object-cover max-h-[265px]" src="/assets/image/image11.png" alt="related image">
                    </div>
                    <div class="col-span-1">
                        <img class="m-auto object-cover max-h-[265px]" src="/assets/image/image11.png" alt="related image">
                    </div>
                    <div class="col-span-1">
                        <img class="m-auto object-cover max-h-[265px]" src="/assets/image/image11.png" alt="related image">
                    </div>
                    <div class="col-span-1">
                        <img class="m-auto object-cover max-h-[265px]" src="/assets/image/image11.png" alt="related image">
                    </div>
                    <div class="col-span-1">
                        <img class="m-auto object-cover max-h-[265px]" src="/assets/image/image11.png" alt="related image">
                    </div>
                    <div class="col-span-1">
                        <img class="m-auto object-cover max-h-[265px]" src="/assets/image/image11.png" alt="related image">
                    </div>
                </div>

            </div>
        </div>
        @include('Components.Projects.ProjectDetailsSlider')
    </div>
</div>






@endsection
