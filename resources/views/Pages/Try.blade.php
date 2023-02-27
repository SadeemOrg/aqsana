@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false, 'left_SideBar' => false])
@section('content')
    <!-- component -->
    @php
        // dd("dd");
        $newDate = date('Y-m-d', strtotime($user['birth_date']));
        $StatWorknewDate = date('Y-m-d', strtotime($user['start_work_date']));
    @endphp

    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <!-- page -->
    <main class="min-h-screen w-full bg-gray-100 text-gray-700 " x-data="layout">
        <!-- header page -->
        <header class="flex w-full items-center justify-between border-b-2 border-gray-200 bg-white p-2">
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <button type="button" class="text-3xl" @click="asideOpen = !asideOpen"><i class="bx bx-menu"></i></button>
                {{-- <p>ss</p> --}}
            </div>
        </header>
        <div class="flex">
            <!-- aside -->
            <nav class=" TabsSidee sm:flex w-72 flex-col space-y-2 border-r-2 border-gray-200 bg-white p-2 "
                aria-label="Tabs" style="height: 115vh" x-show="asideOpen">
                <a href="#" target="_self"
                    class="activeTabs  tabsAlphaA flex items-center  space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span class="text-2xl">
                        <svg class="ml-2" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9 8.99767C7.0146 8.99767 5.4 7.38342 5.4 5.39845C5.4 3.41348 7.0146 1.79923 9 1.79923C10.9854 1.79923 12.6 3.41348 12.6 5.39845C12.6 7.38342 10.9854 8.99767 9 8.99767ZM12.3822 9.60322C13.0123 9.09845 13.5209 8.45852 13.8702 7.73067C14.2194 7.00283 14.4005 6.20573 14.4 5.39845C14.4007 4.48564 14.1698 3.58762 13.729 2.78822C13.2883 1.98883 12.652 1.31413 11.8796 0.827368C11.1072 0.340602 10.2241 0.0576175 9.31259 0.00477986C8.40111 -0.0480578 7.49111 0.131051 6.66766 0.525309C5.8442 0.919567 5.13418 1.51613 4.60396 2.25924C4.07373 3.00234 3.7406 3.86768 3.63573 4.77445C3.53087 5.68122 3.65767 6.59974 4.0043 7.44421C4.35092 8.28868 4.90606 9.03149 5.6178 9.60322C2.3247 10.8405 0 13.8971 0 17.9957H1.8C1.8 13.4967 5.0301 10.7973 9 10.7973C12.9699 10.7973 16.2 13.4967 16.2 17.9957H18C18 13.8971 15.6753 10.8405 12.3822 9.60322Z"
                                fill="black" />
                        </svg>

                    </span>
                    <span>البيانات الشخصية</span>
                </a>
                <a href="#" target="_self"
                    class="tabsAlphaB flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span class="text-2xl">
                        <svg class="ml-2" width="18" height="18" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M32 16C32 7.2 24.8 0 16 0C7.2 0 0 7.2 0 16C0 24.8 7.2 32 16 32C17.7 32 19.4 31.7 21.1 31.2C24.8 33.1 29.3 31.7 31.2 28C32.3 25.8 32.3 23.3 31.2 21.1C31.7 19.4 32 17.7 32 16ZM24.5 31C20.9 31 18 28.1 18 24.5C18 20.9 20.9 18 24.5 18C28.1 18 31 20.9 31 24.5C31 28.1 28.1 31 24.5 31ZM17.8 27.9C17.4 28 16.9 28 16.5 28V26.5C16.5 26.2 16.3 26 16 26C15.7 26 15.5 26.2 15.5 26.5V28C12.7 27.9 10 26.8 7.9 24.8L8.9 23.8C9.1 23.6 9.1 23.3 8.9 23.1C8.7 22.9 8.4 22.9 8.2 23.1L7.2 24.1C5.3 22 4.2 19.3 4 16.5H5.5C5.8 16.5 6 16.3 6 16C6 15.7 5.8 15.5 5.5 15.5H4C4.1 12.7 5.2 10 7.2 7.9L8.2 8.9C8.4 9.1 8.7 9.1 8.9 8.9C9.1 8.7 9.1 8.4 8.9 8.2L7.9 7.2C10 5.3 12.7 4.2 15.5 4V5.5C15.5 5.8 15.7 6 16 6C16.3 6 16.5 5.8 16.5 5.5V4C19.3 4.1 22 5.2 24.1 7.2L23.1 8.2C22.9 8.4 22.9 8.7 23.1 8.9C23.3 9.1 23.6 9.1 23.8 8.9L24.8 7.9C26.7 10 27.8 12.7 28 15.5H26.5C26.2 15.5 26 15.7 26 16C26 16.3 26.2 16.5 26.5 16.5H28C28 16.9 27.9 17.4 27.9 17.8C24.2 15.9 19.7 17.4 17.8 21.1C16.7 23.2 16.7 25.7 17.8 27.9ZM30.5 20C30 19.4 29.5 18.8 28.8 18.4C28.9 17.6 29 16.8 29 16.1C29 8.9 23.2 3.1 16 3.1C12.6 3.1 9.2 4.5 6.8 6.9C1.7 12 1.7 20.2 6.8 25.3C9.2 27.6 12.6 29 16 29C16.8 29 17.6 28.9 18.3 28.8C18.7 29.4 19.3 30 19.9 30.5C18.6 30.9 17.3 31 15.9 31C7.7 31 1 24.3 1 16C1 7.7 7.7 1 16 1C24.3 1 31 7.7 31 16C31 17.3 30.8 18.7 30.5 20ZM21 16C21 15.7 20.8 15.5 20.5 15.5H17.4C17.2 15.1 16.9 14.7 16.5 14.6V8.5C16.5 8.2 16.3 8 16 8C15.7 8 15.5 8.2 15.5 8.5V14.6C14.7 14.9 14.3 15.7 14.6 16.5C14.9 17.3 15.7 17.7 16.5 17.4C16.9 17.2 17.3 16.9 17.4 16.5H20.5C20.8 16.5 21 16.3 21 16ZM16 16.5C15.7 16.5 15.5 16.3 15.5 16C15.5 15.7 15.7 15.5 16 15.5C16.3 15.5 16.5 15.7 16.5 16C16.5 16.3 16.3 16.5 16 16.5ZM23 23.7V24H21.5C21.2 24 21 24.2 21 24.5V26.5C21 26.8 21.2 27 21.5 27H23.5C23.8 27 24 26.8 24 26.5C24 26.2 23.8 26 23.5 26H22V25H23.5C23.8 25 24 24.8 24 24.5V22.5C24 22.2 23.8 22 23.5 22H21.5C21.2 22 21 22.2 21 22.5C21 22.8 21.2 23 21.5 23H23V23.2V23.7ZM27.5 23C27.2 23 27 23.2 27 23.5V24H26V22.5C26 22.2 25.8 22 25.5 22C25.2 22 25 22.2 25 22.5V24.5C25 24.8 25.2 25 25.5 25H27V26.5C27 26.8 27.2 27 27.5 27C27.8 27 28 26.8 28 26.5V23.5C28 23.2 27.8 23 27.5 23Z"
                                fill="black" />
                        </svg>
                    </span>
                    <span>ساعات عملي</span>
                </a>
                <a href="#" target="_self"
                    class="tabsAlphaC flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span class="text-2xl">
                        <svg class="ml-2" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.33258 5.33553C8.36794 5.3399 8.40352 5.3421 8.43915 5.34212C8.61325 5.34192 8.78301 5.28773 8.925 5.18701C9.06699 5.08629 9.17423 4.94401 9.23191 4.77979H9.84375C9.91834 4.77979 9.98988 4.75017 10.0426 4.69744C10.0954 4.64471 10.125 4.5732 10.125 4.49863C10.125 4.42406 10.0954 4.35254 10.0426 4.29982C9.98988 4.24709 9.91834 4.21746 9.84375 4.21746H9.22954C9.2005 4.13255 9.15806 4.05283 9.10382 3.98133C8.98928 3.83444 8.82872 3.73026 8.64787 3.6855V2.73998C8.64787 2.66541 8.61824 2.5939 8.5655 2.54117C8.51275 2.48844 8.44122 2.45882 8.36662 2.45882C8.29203 2.45882 8.2205 2.48844 8.16775 2.54117C8.11501 2.5939 8.08537 2.66541 8.08537 2.73998V3.73408C8.02671 3.76052 7.97124 3.79353 7.92003 3.83248C7.78823 3.93482 7.68974 4.07394 7.63704 4.23224C7.58433 4.39054 7.57977 4.5609 7.62393 4.72179C7.66809 4.88268 7.75899 5.02687 7.88512 5.13611C8.01126 5.24535 8.16699 5.31477 8.33258 5.33553ZM8.26502 4.27651C8.31413 4.23821 8.37465 4.21743 8.43694 4.21746C8.44887 4.21751 8.46079 4.21825 8.47264 4.21966C8.53717 4.22781 8.59687 4.25807 8.64157 4.30529C8.68628 4.35251 8.71323 4.41376 8.71783 4.47861C8.72243 4.54346 8.70439 4.6079 8.6668 4.66095C8.6292 4.714 8.57437 4.75238 8.51165 4.76955C8.44892 4.78672 8.38218 4.78162 8.3228 4.75511C8.26341 4.72861 8.21506 4.68234 8.18597 4.62419C8.15688 4.56604 8.14886 4.49961 8.16327 4.43621C8.17768 4.37281 8.21365 4.31638 8.26502 4.27651ZM17.7188 15.7507H16.875V14.9072C16.8743 14.8644 16.8637 14.8223 16.8439 14.7843C16.8423 14.7811 16.8432 14.7774 16.8415 14.7743L14.2829 10.0007L14.4943 8.96212C14.514 8.85311 14.5121 8.74127 14.4887 8.633C14.4652 8.52473 14.4206 8.42214 14.3574 8.3311C14.2943 8.24007 14.2138 8.16237 14.1206 8.10245C14.0274 8.04253 13.9233 8.00156 13.8142 7.98189L12.7068 7.782C12.6343 7.76924 12.5596 7.78529 12.4988 7.82673C12.4379 7.86817 12.3957 7.93173 12.381 8.00386L11.2818 13.5286C11.2746 13.5652 11.2747 13.6029 11.2821 13.6395C11.2896 13.6761 11.3043 13.7108 11.3253 13.7417C11.3463 13.7725 11.3732 13.7989 11.4045 13.8193C11.4358 13.8396 11.4709 13.8536 11.5076 13.8603L12.6145 14.0601C12.8337 14.0998 13.0597 14.0511 13.2432 13.9248C13.4266 13.7986 13.5527 13.6049 13.5939 13.3861L13.7035 12.8479L14.6696 14.626H13.2188C12.995 14.6262 12.7806 14.7152 12.6224 14.8733C12.4642 15.0314 12.3752 15.2458 12.375 15.4695V15.7506H7.71855C7.81984 15.5806 7.87385 15.3866 7.875 15.1886C7.87466 14.8905 7.75602 14.6046 7.54512 14.3938C7.33421 14.1829 7.04826 14.0643 6.75 14.064L5.90842 14.0641L5.90625 14.0637L5.90408 14.0641L5.30255 14.0642L3.5777 12.6848C3.51416 12.6342 3.44634 12.5893 3.375 12.5505V11.5332C3.375 11.5294 3.37298 11.5262 3.37283 11.5224C3.5475 11.3926 3.68948 11.2238 3.7875 11.0295C3.88552 10.8352 3.93688 10.6207 3.9375 10.4031V7.02911C3.93754 6.97281 3.92066 6.9178 3.88905 6.87121C3.85745 6.82462 3.81258 6.78859 3.76025 6.76779C3.70793 6.74699 3.65056 6.74238 3.59558 6.75455C3.5406 6.76673 3.49055 6.79513 3.45191 6.83608L2.97785 7.338C2.9489 7.36696 2.91432 7.38967 2.87624 7.40474C2.83817 7.4198 2.7974 7.4269 2.75648 7.42559L1.45734 7.34706C1.34246 7.3401 1.22736 7.3567 1.11913 7.39585C1.0109 7.43501 0.91183 7.49589 0.828011 7.57474C0.744192 7.6536 0.677398 7.74876 0.631737 7.85438C0.586076 7.96 0.562514 8.07385 0.5625 8.18891V10.4031C0.56312 10.6207 0.614479 10.8352 0.712497 11.0295C0.810516 11.2238 0.952496 11.3926 1.12717 11.5224C1.12702 11.5262 1.125 11.5294 1.125 11.5332V12.4052C0.807607 12.4703 0.522401 12.6429 0.317469 12.8938C0.112536 13.1447 0.00041193 13.4586 4.73655e-08 13.7825V17.7188C-2.13967e-05 17.7558 0.00723872 17.7923 0.0213653 17.8265C0.0354918 17.8606 0.0562077 17.8916 0.0823284 17.9177C0.108449 17.9438 0.139462 17.9645 0.173595 17.9786C0.207727 17.9928 0.24431 18 0.28125 18H16.5938C16.9666 17.9996 17.324 17.8514 17.5877 17.5878C17.8513 17.3243 17.9996 16.9669 18 16.5942V16.0319C18 15.9949 17.9928 15.9584 17.9786 15.9242C17.9645 15.8901 17.9438 15.8591 17.9177 15.833C17.8916 15.8069 17.8605 15.7862 17.8264 15.772C17.7923 15.7579 17.7557 15.7507 17.7188 15.7507ZM13.0413 13.2798C13.035 13.3163 13.0214 13.3511 13.0015 13.3823C12.9816 13.4134 12.9557 13.4403 12.9253 13.4614C12.8949 13.4825 12.8606 13.4974 12.8244 13.5051C12.7882 13.5129 12.7509 13.5134 12.7145 13.5066L11.8894 13.3578L12.8787 8.38443L13.7142 8.53544C13.7505 8.54192 13.7852 8.55551 13.8162 8.57545C13.8472 8.59538 13.874 8.62126 13.895 8.65159C13.937 8.71081 13.9538 8.78428 13.9416 8.85587L13.0413 13.2798ZM13.8779 11.9907L14.1075 10.8636L16.1241 14.6261H15.31L13.8779 11.9907ZM12.9375 15.4695C12.9376 15.395 12.9673 15.3235 13.02 15.2708C13.0727 15.2181 13.1442 15.1885 13.2188 15.1884H16.3125V15.7507H12.9375V15.4695ZM6.1875 14.6264L6.75 14.6263C6.824 14.6261 6.89732 14.6404 6.96575 14.6686C7.03419 14.6967 7.09639 14.7381 7.1488 14.7903C7.20121 14.8426 7.24279 14.9046 7.27117 14.9729C7.29954 15.0413 7.31414 15.1145 7.31414 15.1885C7.31414 15.2625 7.29954 15.3357 7.27117 15.4041C7.24279 15.4724 7.20121 15.5344 7.1488 15.5867C7.09639 15.6389 7.03419 15.6803 6.96575 15.7084C6.89732 15.7366 6.824 15.7509 6.75 15.7507H6.1875V14.6264ZM1.125 8.71609V8.18891C1.12478 8.15051 1.13253 8.11248 1.14775 8.07723C1.16297 8.04197 1.18534 8.01025 1.21344 7.98407C1.24099 7.95722 1.27396 7.93656 1.31015 7.92349C1.34633 7.91042 1.3849 7.90524 1.42325 7.90829L2.72239 7.98682C2.84275 7.99413 2.96328 7.97556 3.07586 7.93236C3.18843 7.88916 3.29044 7.82235 3.375 7.73641V8.43493H2.53125C2.30755 8.43517 2.09308 8.52412 1.9349 8.68225C1.77672 8.84038 1.68774 9.05479 1.6875 9.27842C1.6874 9.35296 1.65774 9.42442 1.60502 9.47712C1.55229 9.52983 1.48081 9.55949 1.40625 9.55958H1.125V8.71609ZM1.125 10.4031V10.1219H1.40625C1.62995 10.1217 1.84442 10.0327 2.0026 9.87459C2.16078 9.71646 2.24976 9.50205 2.25 9.27842C2.2501 9.20388 2.27976 9.13242 2.33248 9.07971C2.38521 9.02701 2.45669 8.99735 2.53125 8.99725H3.375V10.4031C3.37476 10.6267 3.28578 10.8411 3.1276 10.9992C2.96942 11.1574 2.75495 11.2463 2.53125 11.2466H1.96875C1.74505 11.2463 1.53058 11.1574 1.3724 10.9992C1.21422 10.8411 1.12524 10.6267 1.125 10.4031ZM2.8125 11.7804V12.3864C2.77473 12.3833 2.73738 12.3767 2.69934 12.3767H1.6875V11.7804C1.78006 11.7993 1.87428 11.8089 1.96875 11.8089H2.53125C2.62572 11.8089 2.71994 11.7993 2.8125 11.7804ZM2.8125 16.0318V17.4377H0.5625V13.7825C0.562744 13.5589 0.651718 13.3445 0.809898 13.1864C0.968079 13.0282 1.18255 12.9393 1.40625 12.939H2.69934C2.89084 12.9393 3.07659 13.0045 3.22613 13.1241L5.0279 14.5651C5.07785 14.6049 5.13981 14.6265 5.20368 14.6266L5.625 14.6265V15.7507H4.87519L2.69989 14.12C2.67035 14.0978 2.63673 14.0817 2.60097 14.0726C2.5652 14.0634 2.52798 14.0614 2.49143 14.0666C2.45489 14.0719 2.41973 14.0842 2.38796 14.103C2.3562 14.1219 2.32845 14.1467 2.3063 14.1763C2.28416 14.2058 2.26805 14.2394 2.25889 14.2752C2.24973 14.3109 2.24771 14.3481 2.25294 14.3847C2.25817 14.4212 2.27055 14.4563 2.28936 14.4881C2.30818 14.5199 2.33307 14.5476 2.36261 14.5697L3.93767 15.7507H3.09375C3.05681 15.7507 3.02023 15.7579 2.98609 15.772C2.95196 15.7862 2.92095 15.8069 2.89483 15.833C2.86871 15.8591 2.84799 15.8901 2.83386 15.9242C2.81974 15.9584 2.81248 15.9949 2.8125 16.0318ZM17.4375 16.5942C17.4373 16.8178 17.3483 17.0322 17.1901 17.1903C17.0319 17.3485 16.8175 17.4374 16.5938 17.4377H3.375V16.313H17.4375V16.5942ZM8.4375 7.8726C9.10501 7.8726 9.75753 7.67472 10.3125 7.30398C10.8676 6.93324 11.3001 6.4063 11.5556 5.78979C11.811 5.17328 11.8779 4.49489 11.7477 3.8404C11.6174 3.18591 11.296 2.58473 10.824 2.11287C10.352 1.64101 9.75062 1.31967 9.09593 1.18949C8.44124 1.0593 7.76264 1.12612 7.14594 1.38149C6.52924 1.63685 6.00214 2.0693 5.63129 2.62415C5.26044 3.179 5.0625 3.83132 5.0625 4.49863C5.06348 5.39316 5.41937 6.25078 6.05209 6.88331C6.68482 7.51584 7.54269 7.87162 8.4375 7.8726ZM8.4375 1.68699C8.99376 1.68699 9.53753 1.85189 10 2.16083C10.4626 2.46978 10.823 2.9089 11.0359 3.42266C11.2488 3.93642 11.3045 4.50175 11.196 5.04715C11.0874 5.59256 10.8196 6.09354 10.4262 6.48676C10.0329 6.87997 9.53176 7.14776 8.98619 7.25625C8.44062 7.36473 7.87512 7.30905 7.3612 7.09625C6.84729 6.88344 6.40803 6.52306 6.09899 6.06069C5.78995 5.59832 5.625 5.05472 5.625 4.49863C5.62588 3.7532 5.92247 3.03856 6.44973 2.51147C6.97699 1.98437 7.69185 1.68786 8.4375 1.68699ZM8.4375 8.99725C9.32752 8.99725 10.1975 8.73341 10.9376 8.2391C11.6776 7.74478 12.2544 7.04219 12.595 6.22018C12.9356 5.39816 13.0247 4.49364 12.851 3.62099C12.6774 2.74834 12.2488 1.94676 11.6195 1.31762C10.9901 0.688475 10.1883 0.260022 9.31541 0.0864419C8.44249 -0.0871386 7.53769 0.00194917 6.71542 0.34244C5.89316 0.68293 5.19035 1.25953 4.69589 1.99933C4.20142 2.73912 3.9375 3.60888 3.9375 4.49863C3.93887 5.69132 4.41341 6.83477 5.25703 7.67813C6.10065 8.52149 7.24444 8.99589 8.4375 8.99725ZM8.4375 0.56233C9.21626 0.56233 9.97754 0.79319 10.6251 1.22572C11.2726 1.65824 11.7773 2.27301 12.0753 2.99227C12.3733 3.71154 12.4513 4.50299 12.2993 5.26656C12.1474 6.03013 11.7724 6.73151 11.2217 7.28201C10.6711 7.83251 9.96947 8.20741 9.20567 8.35929C8.44187 8.51117 7.65017 8.43322 6.93068 8.13529C6.2112 7.83736 5.59625 7.33284 5.16359 6.68552C4.73093 6.0382 4.5 5.27715 4.5 4.49863C4.50122 3.45503 4.91645 2.45453 5.65461 1.71659C6.39277 0.978654 7.39358 0.563548 8.4375 0.56233Z"
                                fill="black" />
                        </svg>

                    </span>
                    <span>ساعات عمل الموظفين</span>
                </a>
            </nav>

            <!-- main content page -->
            <div class="tabs-Side-container w-full">
                <div class="container tab tab-A px-8 mx-auto mt-8 max-w-6xl">
                    <div class="flex sm:flex-row flex-col sm:gap-y-0 gap-y-6 items-center justify-between mt-4 xl:mt-8">
                        <div class="relative ">
                            <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right"> لوحة التحكم</p>
                            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37]  w-28 hidden xl:block"></div>
                        </div>
                        <div class="flex ">
                            {{-- <livewire:notification /> --}}
                            <button onclick="startFCM()" class=" Ctnbtn rounded-[50px] bg-transparent text-[#349A37] border-[1px] border-[#349A37]  text-base w-[204px] py-4 font-[700] hover:bg-[#349A37] hover:text-white duration-200">Allow notification
                            </button>
                            <button onclick="location.href='/Admin'"
                                class=" Ctnbtn rounded-[50px] bg-transparent text-[#349A37] border-[1px] border-[#349A37]  text-base w-[204px] py-4 font-[700] hover:bg-[#349A37] hover:text-white duration-200">الذهاب
                                الى المنظومة</button>
                        </div>
                    </div>

                    <!--Tabs -->
                    <div class="mt-12 tabs-Number">
                        <div class="block">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex" aria-label="Tabs">
                                    <a href="#" target="_self" data-tab="tab-1"
                                        class="activeTabs tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">
                                        البيانات الشخصية</a>
                                    <a href="#" target="_self" data-tab="tab-2"
                                        class="tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">البيانات
                                        البنكية </a>
                                    <a href="#" target="_self" data-tab="tab-3"
                                        class="tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">
                                        كلمة المرور</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-container">
                        <!--Form -->
                        <form method="POST" target="_self" action="{{ '/user/update/personaldata' }}" enctype="multipart/form-data"
                            class="tab tab-1  my-6 mt-8">
                            @csrf
                            <!--Perosonal Information -->
                            <div
                                class="  flex flex-row items-center justify-center sm:justify-between gap-x-4 sm:gap-x-0 mt-8 sm:flex-nowrap flex-wrap">
                                <p class="font-FlatBold text-xl sm:text-[22px] text-center lg:mt-8  xl:text-right">البيانات
                                    الشخصية
                                </p>
                                <div class="flex flex-row items-center gap-x-2 ">
                                    <div class="w-[150px] flex items-center justify-center">
                                        <button type="submit"
                                            class="connectUs w-full text-center duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @php
                                $img =
                                    'data:image/png;base64,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';
                            @endphp
                            <div class="flex flex-row items-center justify-center mb-12">
                                <img src="/{{ $img }}" alt=""
                                    class="inline-block h-40 w-40 mt-6 rounded-full" id="chosen"
                                    onclick=" document.getElementById('user_image_uploader').click();">
                                <input type="file" name="image" id="user_image_uploader"
                                    onchange="readURL('chosen', this);" hidden />
                            </div>
                            <div
                                class="flex flex-row items-start justify-center lg:justify-start  flex-wrap gap-y-4 gap-x-6">
                                <div class="">
                                    <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الاسم
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="name" placeholder=" الاسم"
                                            value="{{ $user['name'] }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="text-red-700 ">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الوظيفة
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="job" placeholder=" الوظيفة"
                                            value="{{ $user['job'] ? $user['job'] : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="email" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> البريد
                                        الالكتروني
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="email" placeholder=" الاسم"
                                            value="{{ $user['email'] }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-red-700 ">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <label for="phone" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                        الهاتف
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="phone" placeholder=" رقم التلفون"
                                            value="{{ $user['phone'] ? $user['phone'] : '' }}"
                                            class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="">
                                    <label for="birth_date" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> تاريخ
                                        الميلاد
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" value={{ $newDate }} name="birth_date"
                                            placeholder="الرجاء ادخال تاريخ الميلاد"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4 ">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="id_number" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                        الهوية
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="id_number" placeholder="الرجاء ادخال رقم الهوية"
                                            value="{{ $user['id_number'] ? $user['id_number'] : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="start_work_date" class="block text-sm mr-4 text-[#349A37] font-FlatBold">
                                        بدء
                                        العمل
                                        بالجمعية
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" {{-- value={{ $StatWorknewDate }}  --}} name="start_work_date"
                                            placeholder="الرجاء ادخال تاريخ الميلاد"
                                            value="{{ $user['start_work_date'] ? $StatWorknewDate : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4 text-right">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="city" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> البلد
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="city" placeholder="الرجاء ادخال المدينة"
                                            value="{{ $user['city'] ? $user['city'] : '' }}"
                                            class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="martial_status" class="block text-sm mr-4 text-[#349A37] font-FlatBold">
                                        الحالة
                                        الاجتماعية
                                    </label>
                                    <div class="mt-1 selectdiv">
                                        <select name="martial_status" id="martial_status"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border pr-4 rounded-[60px] sm:text-sm p-4">
                                            <option @if ($user['martial_status'] == null) selected @endif value="">الرجاء
                                                ادخال الحالة الاجتماعية</option>
                                            <option @if ($user['martial_status'] == '1') selected @endif value="1">
                                                {{ __('single') }}</option>
                                            <option @if ($user['martial_status'] == '2') selected @endif value="2">
                                                {{ __('married') }}</option>
                                            <option @if ($user['martial_status'] == '3') selected @endif value="3">
                                                {{ __('separated') }}</option>
                                            <option @if ($user['martial_status'] == '4') selected @endif value="4">
                                                {{ __('engaged') }}</option>
                                            <option @if ($user['martial_status'] == '5') selected @endif value="5">
                                                {{ __('divorced') }}</option>
                                            <option @if ($user['martial_status'] == '6') selected @endif value="6">
                                                {{ __('widower') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--Second Form -->
                        <form class="tab tab-2 my-6 " method="POST" target="_self" action="{{ '/user/update/bankdata' }}" enctype="multipart/form-data">
                            @csrf
                            <div
                                class="  flex flex-row items-center justify-center sm:justify-between gap-x-4 sm:gap-x-0 mt-8  flex-wrap">
                                <p class="font-FlatBold text-xl sm:text-[22px] text-center lg:mt-8  xl:text-right">البيانات
                                    البنكية
                                </p>
                                <div class="flex flex-row items-center gap-x-2 ">
                                    <div class="w-[150px] flex items-center justify-center">
                                        <button type="submit"
                                            class="connectUs w-full text-center duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-8 flex flex-row items-center justify-center lg:justify-start  flex-wrap gap-y-4 gap-x-6">
                                <div class="">
                                    <label for="bank_name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> اسم
                                        البنك
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="bank_name" placeholder="الرجاء ادخال اسم البنك"
                                            value="{{ $user['bank_name'] ? $user['bank_name'] : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="bank_branch" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                        البنك
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="bank_number" placeholder="الرجاء ادخال رقم البنك"
                                            value="{{ $user['bank_number'] ? $user['bank_number'] : 'الرجاء ادخال رقم البنك' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="bank_branch" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                        الفرع
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="bank_branch" placeholder="الرجاء ادخال رقم الفرع"
                                            value="{{ $user['bank_branch'] ? $user['bank_branch'] : 'الرجاء ادخال رقم الفرع' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="account_number"
                                        class="block text-sm mr-4 text-[#349A37] font-FlatBold">رقم
                                        الحساب
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="account_number" placeholder="الرجاء ادخال رقم الحساب"
                                            value="{{ $user['account_number'] ? $user['account_number'] : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--Last Form -->
                        <form class="tab tab-3 my-6 "  method="POST" target="_self" action="{{ '/user/update/password' }}" enctype="multipart/form-data">
                            @csrf
                            <div
                                class="  flex flex-row items-center justify-center sm:justify-between gap-x-4 sm:gap-x-0 my-8  flex-wrap">
                                <p class="font-FlatBold text-xl sm:text-[22px] text-center xl:text-right">كلمة
                                    المرور
                                </p>
                                <div class="flex flex-row items-center gap-x-2 ">
                                    <div class="w-[150px] flex items-center justify-center">
                                        <button type="submit"
                                            class="connectUs w-full text-center duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-4 flex flex-row items-start justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                                <div class="">
                                    <label for="password" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> كلمة
                                        المرور
                                        الحالية
                                    </label>

                                    <div class="mt-1">
                                        <input type="password" id="myInput" name="password"
                                            placeholder="كلمة المرور الحالية" autocomplete="off" value="10203040"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                        <div class=" flex fle-row items-center justify-start gap-x-1 mt-2 mr-3">
                                            <input type="checkbox" onclick="myFunction()">
                                            <p>Show Password</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-red-700 ">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <label for="new_password" class="block text-sm mr-4 text-[#349A37] font-FlatBold">
                                        كلمة
                                        المرور
                                        الجديدة
                                    </label>
                                    <div class="mt-1">
                                        <input type="password" name="new_password" placeholder="كلمة المرور الجديدة"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="Confirm_password"
                                        class="block text-sm mr-4 text-[#349A37] font-FlatBold">تأكيد كلمة
                                        المرور
                                        الجديدة
                                    </label>
                                    <div class="mt-1 ">
                                        <input type="password" name="Confirm_password" placeholder=" تأكيد كلمة المرور"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                    @if ($errors->has('Confirm_password'))
                                        <span
                                            class="text-red-700 mr-4 pt-4">{{ $errors->first('Confirm_password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container tab tab-B px-8 mx-auto mt-8 max-w-6xl hidden">
                    <livewire:work-hours />
                </div>
                <div class="container tab tab-C px-8 mx-auto mt-8 max-w-6xl hidden">
                    <livewire:admin-work-hours />
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("layout", () => ({
                profileOpen: false,
                asideOpen: true,
            }));
        });
    </script>
@endsection
