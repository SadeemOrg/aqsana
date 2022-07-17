<header class="py-3 fixed w-full top-0 right-0 left-0  bg-white sticky-h z-20">
    <div dir="rtl" class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <!-- Start for mobile -->
        <div class="xl:hidden flex justify-between items-center">
            @php
            $img = 'storage/'. nova_get_setting('logo', 'default_value');
        @endphp

            <a href="/">
                <img class="w-[170px] md:w-[200px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="/{{ $img }}" />
            </a>
            <div class="relative mt-2">
                <a class="hamburger" href="#" role="button" title="Open menu" aria-label="Open menu">
                    <span class="hamburger__bar"></span>
                </a>
            </div>
        </div>
        <!-- End for mobile -->
        <div class="nav  xl:flex-row justify-between items-center fixed xl:static right-[-250px] top-[84px] z-10 nav-links">
            <!-- Start RT links -->
            <div class="rt-links basis-2/5  text-base text-[#101426] cursor-pointer text-[15px] xl:text-[16px]" >
                <nav class="">
                    <ul class="navbar-nav xl:flex xl:flex-row justify-between items-center">
                        @if (isset($nav))

                        @foreach ($nav as $key =>$item)

                            @if ($key == (round(count($nav)/2)))
                            <li class="hidden xl:block">
                                @php
                                $img = 'storage/' . nova_get_setting('logo', 'default_value');
                            @endphp
                                <a href="/" target="_self">

                                    <img class=" lg:w-[150px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="/{{ $img }}" />
                                </a>
                            </li>
                            @endif

                            @include( 'layout.front-end.partial.navbar-item', compact('item') )


                        @endforeach
                        @endif
                    </ul>

                </nav>
            </div>
            <!-- End RT links -->
            <!-- Start logo -->
            {{-- <div class="hidden xl:block">
                <a href="/">
                    <img class=" lg:w-[150px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="{{ asset('assets/image/image 1.svg') }}" />
                </a>
            </div> --}}
            <!-- Start logo -->
            <!-- Start LT nav links -->

            <!-- End LT nav links -->
        </div>
    </div>
</header>
