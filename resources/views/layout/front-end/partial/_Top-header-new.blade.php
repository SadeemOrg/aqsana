@php
    $youtube_Logo = nova_get_setting('youtube', 'default_value');
    $tiktok_Link = nova_get_setting('tiktok', 'https://www.tiktok.com/@alaqsa.quds');
    $logo_Banner_Img = 'storage/' . nova_get_setting('logo_Banner_1', 'default_value');
    $whatsapp_phone = nova_get_setting('whatsapp_Connectus', 'default_value');
    $Correct_whatsapp_phone = str_replace(' ', '', $whatsapp_phone);
    $Final_Correct_whatsapp_phone = str_replace('-', '', $Correct_whatsapp_phone);
    $whatsapp_phone_Link = 'https://wa.me/' . $Final_Correct_whatsapp_phone;
    $phone_contact = nova_get_setting('phone_Connectus', 'default_value');
    $email_contact = nova_get_setting('email_Connectus', 'default_value');
@endphp
@if (!isset($hasHeader) || (isset($hasHeader) && $hasHeader))
    @php
        $img = 'storage/' . nova_get_setting('logo', 'default_value');
        $imgRight = 'storage/' . nova_get_setting('qawafelLogo', 'default_value');
        // dd($imgRight);
        @endphp


<header class="h-24 bg-[#349a37] sticky top-0 z-20">
    <div class="flex flex-row justify-start items-start ">
        <!--Start Header left Logo -->
        <div class="hidden lg:flex flex-row items-center justify-center basis-1/6 cursor-pointer"
            onclick="location.href='/'">
            <img class="rounded-[50%] shadow-lg" src="/{{ $img }}" alt="">
        </div>
        <a class="lg:hidden flex flex-row items-center justify-center h-24 w-32 cursor-pointer"
            onclick="location.href='/'">
            <img class="h-full  " src="/{{ $img }}" alt="">
        </a>
        <!--End Header left Logo -->
        <!--Start Center Section -->
        <div class="flex flex-col basis-4/6 max-w-7xl mx-auto">
            <!--Start TopCenter Section -->
            <div class="flex flex-row items-center justify-start ">
                <!--Start first Section On TopHeader -->
                <div class="flex flex-row items-center justify-start border-b-2 border-b-[#FFFFFF8C] w-full">
                    <!--Start SocialMedia On First Section -->
                    <ul class="flex flex-row items-center justify-start gap-x-2 h-12 w-full basis-1/3">
                        <li>
                            <a class="facebook" href="https://www.facebook.com/aqsaassociation/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 22 22" fill="none">
                                    <circle cx="10.9328" cy="10.9328" r="10.4328" stroke="white"></circle>
                                    <g clip-path="url(#clip0_21_1207)">
                                        <path
                                            d="M11.6154 17.1122V11.692H13.434L13.7068 9.57903H11.6154V8.2302C11.6154 7.61864 11.7845 7.20187 12.6625 7.20187L13.7805 7.20141V5.31149C13.5871 5.28636 12.9235 5.22876 12.151 5.22876C10.5381 5.22876 9.43386 6.21328 9.43386 8.02093V9.57903H7.60974V11.692H9.43386V17.1122H11.6154Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_21_1207">
                                            <rect width="11.8834" height="11.8834" fill="white"
                                                transform="translate(4.75336 5.22876)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="instagram" href="https://www.instagram.com/aqsaquds" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25"
                                    viewBox="0 0 23 22" fill="none">
                                    <circle cx="11.8117" cy="10.9328" r="10.4328" stroke="white"></circle>
                                    <g clip-path="url(#clip0_21_1218)">
                                        <path
                                            d="M12.6185 11.1704C12.6185 11.7472 12.1508 12.2149 11.574 12.2149C10.9972 12.2149 10.5296 11.7472 10.5296 11.1704C10.5296 10.5936 10.9972 10.126 11.574 10.126C12.1508 10.126 12.6185 10.5936 12.6185 11.1704Z"
                                            fill="white"></path>
                                        <path
                                            d="M13.338 8.01392H9.81007C9.04215 8.01392 8.41748 8.63859 8.41748 9.40651V12.9344C8.41748 13.7023 9.04215 14.327 9.81007 14.327H13.338C14.1059 14.327 14.7306 13.7023 14.7306 12.9344V9.40651C14.7306 8.63859 14.1059 8.01392 13.338 8.01392ZM11.574 12.9112C10.6142 12.9112 9.83328 12.1303 9.83328 11.1705C9.83328 10.2106 10.6142 9.42972 11.574 9.42972C12.5339 9.42972 13.3148 10.2106 13.3148 11.1705C13.3148 12.1303 12.5339 12.9112 11.574 12.9112ZM13.5701 9.52256C13.3778 9.52256 13.2219 9.36671 13.2219 9.17441C13.2219 8.98211 13.3778 8.82626 13.5701 8.82626C13.7624 8.82626 13.9182 8.98211 13.9182 9.17441C13.9182 9.36671 13.7624 9.52256 13.5701 9.52256Z"
                                            fill="white"></path>
                                        <path
                                            d="M14.3824 5.22876H8.76565C7.03797 5.22876 5.63232 6.63441 5.63232 8.36209V13.9789C5.63232 15.7066 7.03797 17.1122 8.76565 17.1122H14.3824C16.1101 17.1122 17.5158 15.7066 17.5158 13.9789V8.36209C17.5158 6.63441 16.1101 5.22876 14.3824 5.22876ZM15.4269 12.9344C15.4269 14.0862 14.4898 15.0233 13.338 15.0233H9.8101C8.65831 15.0233 7.72121 14.0862 7.72121 12.9344V9.40653C7.72121 8.25474 8.65831 7.31765 9.8101 7.31765H13.338C14.4898 7.31765 15.4269 8.25474 15.4269 9.40653V12.9344Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_21_1218">
                                            <rect width="11.8834" height="11.8834" fill="white"
                                                transform="translate(5.63232 5.22876)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="twitter" href="https://twitter.com/AqsaAss" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25"
                                    viewBox="0 0 23 22" fill="none">
                                    <circle cx="11.6908" cy="10.9328" r="10.4328" stroke="white"></circle>
                                    <g clip-path="url(#clip0_21_1212)">
                                        <path
                                            d="M17.3948 7.48581C16.9529 7.67966 16.482 7.80815 15.9911 7.87054C16.4961 7.569 16.8816 7.09514 17.0628 6.524C16.5919 6.80474 16.072 7.00305 15.518 7.11371C15.0708 6.63763 14.4336 6.34277 13.7384 6.34277C12.3896 6.34277 11.3038 7.43754 11.3038 8.77962C11.3038 8.97273 11.3201 9.15841 11.3602 9.33517C9.33485 9.23639 7.54268 8.26566 6.33874 6.78692C6.12855 7.15159 6.00526 7.569 6.00526 8.01834C6.00526 8.86206 6.43975 9.60998 7.08739 10.043C6.69598 10.0356 6.312 9.92192 5.98669 9.74292C5.98669 9.75035 5.98669 9.76001 5.98669 9.76966C5.98669 10.9535 6.83116 11.9369 7.93855 12.1634C7.74024 12.2176 7.52411 12.2436 7.29981 12.2436C7.14384 12.2436 6.98638 12.2347 6.83858 12.2021C7.15424 13.1668 8.04995 13.8761 9.11501 13.8992C8.28614 14.5475 7.23371 14.9382 6.09438 14.9382C5.89459 14.9382 5.70297 14.9293 5.51135 14.9048C6.59052 15.6007 7.86947 15.9981 9.2487 15.9981C13.7317 15.9981 16.1827 12.2845 16.1827 9.06557C16.1827 8.95787 16.179 8.85389 16.1738 8.75066C16.6573 8.40752 17.0635 7.97897 17.3948 7.48581Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_21_1212">
                                            <rect width="11.8834" height="11.8834" fill="white"
                                                transform="translate(5.51135 5.22876)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="youtube" href="https://www.youtube.com/channel/UCuumAw7vPSQJeC6FTOkH37g"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25"
                                    viewBox="0 0 23 22" fill="none">
                                    <circle cx="11.5697" cy="10.9328" r="10.4328" stroke="white"></circle>
                                    <g clip-path="url(#clip0_21_1202)">
                                        <path d="M10.5185 12.113L12.4806 11.0579L10.5185 9.98425V12.113Z"
                                            fill="white">
                                        </path>
                                        <path
                                            d="M17.1863 8.79206L17.1858 8.78662C17.1757 8.69097 17.0756 7.84009 16.6619 7.40745C16.1839 6.89846 15.6419 6.83663 15.3812 6.80698C15.3597 6.80445 15.3399 6.80227 15.3222 6.79991L15.3015 6.79774C13.7304 6.6835 11.3579 6.66791 11.3341 6.66772H11.3299C11.3062 6.66791 8.93362 6.6835 7.34847 6.79774L7.32752 6.79991C7.31066 6.80218 7.29207 6.80426 7.27186 6.80662C7.01419 6.83636 6.47801 6.89828 5.99858 7.42558C5.60465 7.85378 5.49077 8.68635 5.47908 8.77991L5.47772 8.79206C5.47418 8.83186 5.39032 9.77939 5.39032 10.7306V11.6199C5.39032 12.5711 5.47418 13.5186 5.47772 13.5584L5.47835 13.5645C5.48842 13.6585 5.58851 14.4937 6.00021 14.9266C6.44972 15.4187 7.01809 15.4837 7.32381 15.5187C7.37213 15.5242 7.41383 15.529 7.44212 15.534L7.46959 15.5377C8.37668 15.6241 11.2207 15.6666 11.3413 15.6683L11.3449 15.6684L11.3484 15.6683C11.3723 15.6682 13.7448 15.6527 15.3158 15.5383L15.3365 15.5362C15.3563 15.5336 15.3786 15.5313 15.4031 15.5287C15.6594 15.5015 16.1926 15.445 16.6655 14.9249C17.0594 14.4967 17.1733 13.6641 17.185 13.5706L17.1863 13.5584C17.1899 13.5186 17.2737 12.5711 17.2737 11.6199V10.7306C17.2737 9.77939 17.1899 8.83195 17.1863 8.79206ZM13.1581 11.4842L10.5327 12.8959C10.4607 12.9347 10.3823 12.9541 10.3042 12.9541C10.2189 12.9541 10.1337 12.931 10.0569 12.8852C9.90989 12.7973 9.82212 12.6425 9.82212 12.4713V9.62299C9.82212 9.45091 9.91043 9.29588 10.0584 9.20811C10.2064 9.12044 10.3849 9.11727 10.5358 9.19986L13.1612 10.6364C13.3165 10.7214 13.4126 10.8842 13.4119 11.0613C13.4113 11.2383 13.314 11.4004 13.1581 11.4842Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_21_1202">
                                            <rect width="11.8834" height="11.8834" fill="white"
                                                transform="translate(5.39032 5.22876)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li class="TikTok">
                            <a href="{{ $tiktok_Link }}">
                                <svg width="25" height="25" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10.9328" cy="10.9328" r="10.4328" stroke="white" />
                                    <path
                                        d="M14.7547 7.35251C14.6768 7.31414 14.601 7.27207 14.5275 7.22647C14.3139 7.09183 14.1181 6.93319 13.9442 6.75395C13.5091 6.27937 13.3467 5.79792 13.2868 5.46083H13.2892C13.2392 5.18103 13.2599 5 13.263 5H11.2815V12.305C11.2815 12.4031 11.2815 12.5 11.2772 12.5958C11.2772 12.6077 11.2759 12.6187 11.2752 12.6316C11.2752 12.6368 11.2752 12.6423 11.274 12.6478C11.274 12.6492 11.274 12.6506 11.274 12.652C11.2531 12.9141 11.165 13.1672 11.0174 13.3893C10.8698 13.6113 10.6672 13.7953 10.4275 13.9251C10.1776 14.0607 9.89505 14.1317 9.6076 14.1314C8.68438 14.1314 7.93613 13.4137 7.93613 12.5273C7.93613 11.6409 8.68438 10.9232 9.6076 10.9232C9.78237 10.9231 9.95605 10.9493 10.1222 11.0009L10.1246 9.07736C9.62019 9.01524 9.10773 9.05346 8.61957 9.18961C8.13141 9.32576 7.67814 9.55688 7.28836 9.8684C6.94682 10.1513 6.65969 10.4889 6.43989 10.8659C6.35624 11.0034 6.04065 11.5559 6.00243 12.4526C5.97839 12.9615 6.13872 13.4888 6.21515 13.7068V13.7113C6.26322 13.8397 6.4495 14.2776 6.75308 14.6467C6.99787 14.9429 7.28708 15.203 7.61141 15.4188V15.4142L7.61621 15.4188C8.57549 16.0402 9.63909 15.9995 9.63909 15.9995C9.82321 15.9923 10.44 15.9995 11.1404 15.683C11.9172 15.3322 12.3595 14.8094 12.3595 14.8094C12.642 14.4971 12.8667 14.1412 13.0239 13.7569C13.2032 13.3076 13.263 12.7686 13.263 12.5532V8.67771C13.287 8.69146 13.6072 8.89335 13.6072 8.89335C13.6072 8.89335 14.0685 9.17521 14.7881 9.35876C15.3044 9.48938 16 9.51688 16 9.51688V7.64147C15.7563 7.66668 15.2614 7.59335 14.7547 7.35251Z"
                                        fill="#F0E8E8" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $whatsapp_phone_Link }}" class="whatsApp">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25"
                                    height="25" viewBox="0 0 50 50" style=" fill:white;">
                                    <path
                                        d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 29.079097 3.1186875 32.88588 4.984375 36.208984 L 2.0371094 46.730469 A 1.0001 1.0001 0 0 0 3.2402344 47.970703 L 14.210938 45.251953 C 17.434629 46.972929 21.092591 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 21.278025 46 17.792121 45.029635 14.761719 43.333984 A 1.0001 1.0001 0 0 0 14.033203 43.236328 L 4.4257812 45.617188 L 7.0019531 36.425781 A 1.0001 1.0001 0 0 0 6.9023438 35.646484 C 5.0606869 32.523592 4 28.890107 4 25 C 4 13.390466 13.390466 4 25 4 z M 16.642578 13 C 16.001539 13 15.086045 13.23849 14.333984 14.048828 C 13.882268 14.535548 12 16.369511 12 19.59375 C 12 22.955271 14.331391 25.855848 14.613281 26.228516 L 14.615234 26.228516 L 14.615234 26.230469 C 14.588494 26.195329 14.973031 26.752191 15.486328 27.419922 C 15.999626 28.087653 16.717405 28.96464 17.619141 29.914062 C 19.422612 31.812909 21.958282 34.007419 25.105469 35.349609 C 26.554789 35.966779 27.698179 36.339417 28.564453 36.611328 C 30.169845 37.115426 31.632073 37.038799 32.730469 36.876953 C 33.55263 36.755876 34.456878 36.361114 35.351562 35.794922 C 36.246248 35.22873 37.12309 34.524722 37.509766 33.455078 C 37.786772 32.688244 37.927591 31.979598 37.978516 31.396484 C 38.003976 31.104927 38.007211 30.847602 37.988281 30.609375 C 37.969311 30.371148 37.989581 30.188664 37.767578 29.824219 C 37.302009 29.059804 36.774753 29.039853 36.224609 28.767578 C 35.918939 28.616297 35.048661 28.191329 34.175781 27.775391 C 33.303883 27.35992 32.54892 26.991953 32.083984 26.826172 C 31.790239 26.720488 31.431556 26.568352 30.914062 26.626953 C 30.396569 26.685553 29.88546 27.058933 29.587891 27.5 C 29.305837 27.918069 28.170387 29.258349 27.824219 29.652344 C 27.819619 29.649544 27.849659 29.663383 27.712891 29.595703 C 27.284761 29.383815 26.761157 29.203652 25.986328 28.794922 C 25.2115 28.386192 24.242255 27.782635 23.181641 26.847656 L 23.181641 26.845703 C 21.603029 25.455949 20.497272 23.711106 20.148438 23.125 C 20.171937 23.09704 20.145643 23.130901 20.195312 23.082031 L 20.197266 23.080078 C 20.553781 22.728924 20.869739 22.309521 21.136719 22.001953 C 21.515257 21.565866 21.68231 21.181437 21.863281 20.822266 C 22.223954 20.10644 22.02313 19.318742 21.814453 18.904297 L 21.814453 18.902344 C 21.828863 18.931014 21.701572 18.650157 21.564453 18.326172 C 21.426943 18.001263 21.251663 17.580039 21.064453 17.130859 C 20.690033 16.232501 20.272027 15.224912 20.023438 14.634766 L 20.023438 14.632812 C 19.730591 13.937684 19.334395 13.436908 18.816406 13.195312 C 18.298417 12.953717 17.840778 13.022402 17.822266 13.021484 L 17.820312 13.021484 C 17.450668 13.004432 17.045038 13 16.642578 13 z M 16.642578 15 C 17.028118 15 17.408214 15.004701 17.726562 15.019531 C 18.054056 15.035851 18.033687 15.037192 17.970703 15.007812 C 17.906713 14.977972 17.993533 14.968282 18.179688 15.410156 C 18.423098 15.98801 18.84317 16.999249 19.21875 17.900391 C 19.40654 18.350961 19.582292 18.773816 19.722656 19.105469 C 19.863021 19.437122 19.939077 19.622295 20.027344 19.798828 L 20.027344 19.800781 L 20.029297 19.802734 C 20.115837 19.973483 20.108185 19.864164 20.078125 19.923828 C 19.867096 20.342656 19.838461 20.445493 19.625 20.691406 C 19.29998 21.065838 18.968453 21.483404 18.792969 21.65625 C 18.639439 21.80707 18.36242 22.042032 18.189453 22.501953 C 18.016221 22.962578 18.097073 23.59457 18.375 24.066406 C 18.745032 24.6946 19.964406 26.679307 21.859375 28.347656 C 23.05276 29.399678 24.164563 30.095933 25.052734 30.564453 C 25.940906 31.032973 26.664301 31.306607 26.826172 31.386719 C 27.210549 31.576953 27.630655 31.72467 28.119141 31.666016 C 28.607627 31.607366 29.02878 31.310979 29.296875 31.007812 L 29.298828 31.005859 C 29.655629 30.601347 30.715848 29.390728 31.224609 28.644531 C 31.246169 28.652131 31.239109 28.646231 31.408203 28.707031 L 31.408203 28.708984 L 31.410156 28.708984 C 31.487356 28.736474 32.454286 29.169267 33.316406 29.580078 C 34.178526 29.990889 35.053561 30.417875 35.337891 30.558594 C 35.748225 30.761674 35.942113 30.893881 35.992188 30.894531 C 35.995572 30.982516 35.998992 31.07786 35.986328 31.222656 C 35.951258 31.624292 35.8439 32.180225 35.628906 32.775391 C 35.523582 33.066746 34.975018 33.667661 34.283203 34.105469 C 33.591388 34.543277 32.749338 34.852514 32.4375 34.898438 C 31.499896 35.036591 30.386672 35.087027 29.164062 34.703125 C 28.316336 34.437036 27.259305 34.092596 25.890625 33.509766 C 23.114812 32.325956 20.755591 30.311513 19.070312 28.537109 C 18.227674 27.649908 17.552562 26.824019 17.072266 26.199219 C 16.592866 25.575584 16.383528 25.251054 16.208984 25.021484 L 16.207031 25.019531 C 15.897202 24.609805 14 21.970851 14 19.59375 C 14 17.077989 15.168497 16.091436 15.800781 15.410156 C 16.132721 15.052495 16.495617 15 16.642578 15 z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <!--End SocialMedia On First Section -->
                    <!--Start Email and Telephone Sections -->
                    <div class="hidden lg:flex flex-start items-center gap-x-4  xl:gap-x-8 justify-end basis-2/3">
                        <div class="flex flex-row items-center justify-start gap-x-2">
                            <img src="{{ asset('assets/image/message.svg') }}" alt="message"
                                class="max-w-[17px] max-h-[17px]">
                            <a href="mailto:alaqsaquds@gmail.com"
                                class="text-white text-[16px] inter-font">{{ $email_contact }}</a>
                        </div>
                        <div class="flex flex-row items-center justify-start gap-x-2 ">
                            <img src="{{ asset('assets/image/telephone.svg') }}" alt="telephone"
                                class="max-w-[17px] max-h-[17px]">
                            <p itemprop="telephone" dir="ltr" class="text-white text-[16px] inter-font">
                                <a> {{ $phone_contact }} </a>
                            </p>
                        </div>
                        <div class="flex flex-row items-center justify-start gap-x-2 ">
                            <img src="{{ asset('assets/image/location-sign-svgrepo-com.svg') }}" alt="telephone"
                                class="max-w-[17px] max-h-[17px]">
                            <p itemprop="telephone" dir="ltr" class="text-white text-[16px] inter-font">
                                <a> كفر برا </a>
                            </p>
                        </div>
                    </div>
                    <!--End Email and Telephone Sections -->

                </div>
            </div>
            <!--End TopCenter Section -->
            <!--Start BottomCenter Section -->
            @if (!isset($hasHeader) || (isset($hasHeader) && $hasHeader))
                <!--Start NavBar Section -->
                <div class="nav xl:flex-row justify-between items-center fixed xl:static right-[-200px] w-[200px] xl:w-auto top-[96px]  z-10 nav-links ">
                    <div class="rt-links">
                        <nav>
                            <ul
                                class="navbar-nav h-[50px] xl:flex xl:flex-row justify-between items-center gap-x-4 2xl:gap-x-8">
                                @if (isset($nav))
                                    @foreach ($nav as $key => $item)
                                        @if (empty($item->children))
                                            <li class="nav-item relative ">
                                                <a class="w-auto text-[15px] mb-3 xl:mb-0 xl:hover:text-[#e69c25] bg-[#349A37] xl:bg-transparent text-white block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                                    href="/{{ $item->data->link->id }}"
                                                    target="_self">{{ $item->data->name }}</a>
                                            </li>
                                        @else
                                            <li class="nav-item relative">
                                                @if ($item->data->link->resource == 'external')
                                                    <a class="w-auto text-[15px] mb-3 xl:mb-0 xl:hover:text-[#e69c25] bg-[#349A37] xl:bg-transparent text-white block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                                        href="/{{ $item->data->link->id }}"
                                                        target="_self">{{ $item->data->name }}</a>
                                                @else
                                                    <a class="stop-link w-auto text-[15px] mb-3 xl:mb-0 xl:hover:text-[#e69c25] bg-[#349A37] xl:bg-transparent text-white block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                                        href=""> {{ $item->data->name }}
                                                    </a>
                                                @endif
                                                <div
                                                    class="dropdown-menu drop-shadow-lg bg-white rounded-[5px] right-[110%] xl:right-[0] top-[100%]">
                                                    <ul>
                                                        @include('layout.front-end.partial.navbar-dropdown',
                                                            [
                                                                'items' => $item->children,
                                                                'itemName' => $item->data->name,
                                                            ])
                                                    </ul>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--End NavBar Section -->
            @endif
            <!--End BottomCenter Section -->
        </div>
        <!--End Center Section -->
        <!--Start Header Right Logo -->
        <div class="hidden xl:flex flex-row items-center justify-center basis-1/6 cursor-pointer"
            onclick="location.href='/sector/5'">
            <img class="rounded-[45%] shadow-lg"
             {{-- src="{{ $imgRight }}" --}}
             src="{{ asset('assets/image/QawafelLogo.png') }}"
                alt="logoQawafel">
        </div>
        <div class="xl:hidden flex justify-center basis-[20%] items-center cursor-pointer">
            <div class="relative mt-12">
                <a class="hamburger" href="#" role="button" title="Open menu" aria-label="Open menu">
                    <span class="hamburger__bar"></span>
                </a>
            </div>
        </div>
        <!--End Header Right Logo -->
    </div>
</header>
@endif
