<header class="py-3 fixed w-full top-0 right-0 left-0  bg-white sticky-h z-20">
    @php
    $img = 'storage/' . nova_get_setting('logo', 'default_value');
    $rightNaVNumber = round(count($nav)/2);
    $rightNav = array_slice($nav, 0, $rightNaVNumber);
    $leftNav = array_slice($nav, $rightNaVNumber);
    @endphp


    <div dir="rtl" class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <!-- Start for mobile -->
        <div class="xl:hidden flex justify-between items-center">
            @php
            $img = 'storage/'. nova_get_setting('logo', 'default_value');
            @endphp
            <a target="_self" href="/">
                <img class="w-[170px] md:w-[200px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="/{{ $img }}" />
            </a>
            <div class="relative mt-2">
                <a class="hamburger" href="#" role="button" title="Open menu" aria-label="Open menu">
                    <span class="hamburger__bar"></span>
                </a>
            </div>
        </div>
        <!-- End for mobile -->
        <div
            class="nav  xl:flex-row justify-between items-center fixed xl:static right-[-250px] top-[84px] z-10 nav-links">
            <!-- Start RT links -->
            <div class="rt-links basis-2/5  text-base text-[#101426] cursor-pointer text-[15px] xl:text-[16px]">
                <nav class="xl:flex xl:flex-row justify-between items-center">
                    <!-- Start RT logo -->
                    <ul class="navbar-nav xl:flex xl:flex-row justify-between items-center basis-2/5">
                        @if (isset($nav))
                        @foreach ($nav as $key =>$item)
                        @if ($key < $rightNaVNumber) <!-- Start for RightSide desktop -->
                            @if (empty($item->children))
                            <li class="nav-item relative ">
                                <a class=" w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                    href="/{{ $item->data->link->id }}" target="_self">{{$item->data->name}}</a>
                            </li>
                            @else
                            <li class="nav-item relative">
                                @if ( $item->data->link->resource=='external')
                                <a class=" w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                    href="/{{ $item->data->link->id }}" target="_self">{{$item->data->name}}</a>
                                @else
                                <a class="stop-link w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                    href=""> {{$item->data->name}}
                                </a>
                                @endif

                                <div
                                    class="dropdown-menu drop-shadow-lg bg-white rounded-[5px] right-[110%] xl:right-[0] top-[100%]">
                                    <ul>
                                        @include('layout.front-end.partial.navbar-dropdown', ['items' =>
                                        $item->children])
                                    </ul>
                                </div>
                            </li>
                            @endif
                            @endif
                            @endforeach
                            @endif
                    </ul>
                    <!-- end RT logo -->

                    <!--logo Side -->
                    <li class="hidden xl:flex justify-center items-center basis-1/5">
                        <a href="/" target="_self">
                            <img class=" lg:w-[150px] xl:w-[200px] lg:h-auto xl:h-[60px]" src="/{{ $img }}" />
                        </a>
                    </li>
                    <!--end Logo side -->

                    <!-- start LT Nav -->
                    <ul class="navbar-nav xl:flex xl:flex-row justify-between items-center basis-2/5">
                        @if (isset($nav))
                        @foreach ($nav as $key =>$item)
                        @if ($key >= $rightNaVNumber)
                        <!-- Start for LeftSide desktop -->
                            @if (empty($item->children))
                            <li class="nav-item relative ">
                                <a class=" w-[250px] xl:w-auto xl:text-[16px] font-FlatBold mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                    href="/{{ $item->data->link->id }}" target="_self">{{$item->data->name}}</a>
                            </li>
                            @else
                            <li class="nav-item relative">
                                @if ( $item->data->link->resource=='external')
                                <a class=" w-[250px] xl:w-auto xl:text-[16px] font-FlatBold mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                    href="/{{ $item->data->link->id }}" target="_self">{{$item->data->name}}</a>
                                @else
                                <a class="stop-link w-[250px] xl:w-auto xl:text-[16px] font-FlatBold mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                    href=""> {{$item->data->name}}
                                </a>
                                @endif

                                <div
                                    class="dropdown-menu drop-shadow-lg bg-white rounded-[5px] right-[110%] xl:right-[0] top-[100%]">
                                    <ul>
                                        @include('layout.front-end.partial.navbar-dropdown', ['items' =>$item->children])
                                    </ul>
                                </div>
                            </li>
                            @endif
                            @endif
                            @endforeach
                            @endif
                    </ul>
                    <!-- end LT Nav -->

                </nav>
            </div>
        </div>
    </div>
</header>
