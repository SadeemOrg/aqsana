@if (!isset($hasHeader) || (isset($hasHeader) && $hasHeader))
    <header class="py-3 fixed w-full top-12 right-0 left-0  bg-white sticky-h z-20 ">
        @php
            $img = 'storage/' . nova_get_setting('logo', 'default_value');
        @endphp


        <div dir="rtl" class="max-w-7xl mx-auto  px-4 sm:px-6 lg:px-8 ">
            <!-- Start for mobile -->
            <div class="xl:hidden flex justify-between items-center">
                @php
                    $img = 'storage/' . nova_get_setting('logo', 'default_value');
                @endphp
                <a target="_self" href="/">
                    <img class="w-32 h-[70px]" 
                    src="/{{ $img }}"/>
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
                <div class="rt-links text-base text-[#101426] cursor-pointer text-[15px] xl:text-[16px]">
                    <nav class="xl:flex xl:flex-row justify-between items-center">
                        <!--logo Right Side Side -->
                        <li class="hidden xl:flex justify-center items-center basis-1/6">
                            <a href="/" target="_self">
                                <img class="w-32 h-[70px]" src="/{{ $img }}"
                                    {{-- src="https://media.discordapp.net/attachments/938405759996276806/1041689893664985118/9a67de7e-4803-4aba-9b46-e7c1e8d3885b.jpg?width=659&height=606"  --}}
                                    />
                            </a>
                        </li>
                        <!--end Logo side -->
                        <!-- Start RT logo -->
                        <ul class="navbar-nav xl:flex xl:flex-row justify-between items-center gap-x-4 basis-4/6">
                            @if (isset($nav))
                                @foreach ($nav as $key => $item)
                                    @if (empty($item->children))
                                        <li class="nav-item relative ">
                                            <a class="w-auto text-sm mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                                href="/{{ $item->data->link->id }}"
                                                target="_self">{{ $item->data->name }}</a>
                                        </li>
                                    @else
                                        <li class="nav-item relative">
                                            @if ($item->data->link->resource == 'external')
                                                <a class="w-auto text-sm mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                                    href="/{{ $item->data->link->id }}"
                                                    target="_self">{{ $item->data->name }}</a>
                                            @else
                                                <a class="stop-link w-auto text-sm mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"
                                                    href=""> {{ $item->data->name }}
                                                </a>
                                            @endif

                                            <div
                                                class="dropdown-menu drop-shadow-lg bg-white rounded-[5px] right-[110%] xl:right-[0] top-[100%]">
                                                <ul>
                                                    @include('layout.front-end.partial.navbar-dropdown', [
                                                        'items' => $item->children,
                                                    ])
                                                </ul>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <!-- end RT logo -->


                        <!--logo left Side -->
                        <li class="hidden xl:flex justify-center items-center basis-1/6">
                            <a href="/" target="_self">
                                <img class="w-32 h-[70px]"
                                    {{-- src="/{{ $img }}"  --}}
                                    src="https://media.discordapp.net/attachments/938405759996276806/1041691394949005352/Screenshot_2022-11-14_142923.png" />
                            </a>
                        </li>
                        <!--end Logo side -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
@endif
