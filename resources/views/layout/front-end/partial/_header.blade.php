<header class="py-3 fixed w-full top-0 right-0 left-0 z-10 bg-white sticky-h">
    <div dir="rtl" class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <!-- Start for mobile -->
        <div class="xl:hidden flex justify-between items-center">
            <a href="#">
                <img class="w-[170px] md:w-[200px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="{{ asset('assets/image/image 1.svg') }}" />
            </a>
            <div class="relative mt-2">
                <a class="hamburger" href="#" role="button" title="Open menu" aria-label="Open menu">
                    <span class="hamburger__bar"></span>
                </a>
            </div>
        </div>
        <!-- End for mobile -->
        <div class="nav xl:flex xl:flex-row justify-between items-center fixed xl:static right-[-250px] top-[84px] z-10 nav-links">
            <!-- Start RT links -->
            <div class="rt-links basis-2/5  text-base text-[#101426] cursor-pointer text-[15px] xl:text-[16px]" >
                <nav class="">
                    <ul class="navbar-nav xl:flex xl:flex-row justify-between items-center">
                        <li class="nav-item relative">
                            <a class=" w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"  href="/aboutus">من نحن</a>
                        </li>
                        <li class="nav-item relative" onclick="location.href='our-project'">
                            <a   class="stop-link w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static" >مشاريعنا</a>
                            <div class="dropdown-menu drop-shadow-lg bg-white rounded-[5px] right-[110%] xl:right-[0] top-[100%]">
                                <ul>
                                    <li>
                                        <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="our-project/1">مشروع إفطار الصائم</a>
                                    </li>
                                    <li>
                                        <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="our-project/2">مشروع إفطار الصائم</a>
                                    </li>
                                    <li>
                                        <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="/yearly-news">مشروع إفطار الصائم</a>
                                    </li>
                                    <li>
                                        <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="#">مشروع إفطار الصائم</a>
                                    </li>
                                    <li>
                                        <a class="py-2 block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="#">مشروع إفطار الصائم</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item relative">
                            <a class="w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static" href="/our-news">اخبارنا</a>
                        </li>
                        <li class="nav-item relative">
                            <a class="w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static" href="#">القدس والمسجد الاقصى</a>
                        </li>
                    </ul>

                </nav>
            </div>
            <!-- End RT links -->
            <!-- Start logo -->
            <div class="hidden xl:block">
                <a href="/">
                    <img class=" lg:w-[150px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="{{ asset('assets/image/image 1.svg') }}" />
                </a>
            </div>
            <!-- Start logo -->
            <!-- Start LT nav links -->
            <div class="lt-links basis-2/5 text-base text-[#101426] cursor-pointer text-[15px] xl:text-[16px]">
                <nav class="">
                    <ul class="navbar-nav xl:flex xl:flex-row justify-between items-center">
                        <li class="nav-item relative">
                            <a class="w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0 xl:inline-block relative xl:static" href="#">الاوقاف والمقدسات</a>
                        </li>
                        <li class="nav-item relative">
                            <a class="w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0 xl:inline-block relative xl:static" href="/yearly-news">حصاد الجمعية</a>
                        </li>
                        <li class="nav-item relative">
                            <a class="w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0 xl:inline-block relative xl:static" href="project-donations"> التبرع للمشاريع</a>
                        </li>
                        <li class="nav-item relative">
                            <a class="w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0 xl:inline-block relative xl:static" href="/contact">اتصل بنا</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End LT nav links -->
        </div>
    </div>
</header>
