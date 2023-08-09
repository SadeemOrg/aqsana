    @if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))


        <h3 class="flex items-center justify-between font-normal text-white mb-6 text-base no-underline main-items">
            <div class="flex items-center">
                <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill="#fff"
                        d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z" />
                </svg>


                <span class="sidebar-label cursor-pointer">{{ __('Resources') }}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" class="ml-2"><path fill="#fff" d="M8.292893.292893c.390525-.390524 1.023689-.390524 1.414214 0 .390524.390525.390524 1.023689 0 1.414214l-4 4c-.390525.390524-1.023689.390524-1.414214 0l-4-4c-.390524-.390525-.390524-1.023689 0-1.414214.390525-.390524 1.023689-.390524 1.414214 0L5 3.585786 8.292893.292893z"></path></svg>
        </h3>


        @php

            $arrSort = [];
            foreach ($navigation as $group => $resources) {
                $resourcesGruoupOrders = [];
                foreach ($resources as $aResource) {
                    $resourcesGruoupOrders[] = $aResource::groupOrder();
                }
                $arrSort[] = min($resourcesGruoupOrders);
            }
            $navigation = json_decode(json_encode($navigation), true);
            array_multisort($navigation, SORT_ASC, SORT_NUMERIC, $arrSort);
            //   dd($navigation);
        @endphp

        <div class="room-sort" style="display:none">

            <ul style="list-style-type: none" class="room-sort-menu">
                @foreach ($navigation as $group => $resources)
                    <li class="dropdown">
                        <a style="line-height: 2.5rem/* 40px */; font-weight: 700; font-size: 16px;"
                        class="dropBtn  mb-4 text-base text-white uppercase tracking-wide cursor-pointer text"  href="#"> {{ $group }} <i class="fa fa-caret-down"
                                aria-hidden="true"></i></a>
                        <ul class="dropMenu" style="list-style-type:none;">
                            @foreach ($resources as $resource)
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'index',
                                            params: {
                                                resourceName: '{{ $resource::uriKey() }}'
                                            }
                                        }"
                                        class="text-white text-justify no-underline dim ml-2"
                                        style="font-size: 15px"
                                        dusk="{{ $resource::uriKey() }}-resource-link">
                                        {{ $resource::label() }}
                                    </router-link>
                                </li>

                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

        </div>

        <script>
            function thisindex(elm) {
                var nodes = elm.parentNode.childNodes,
                    node;
                var i = 0,
                    count = i;
                while ((node = nodes.item(i++)) && node != elm)
                    if (node.nodeType == 1) count++;
                return count;
            }

            function closeAll(index) {
                var len = document.getElementsByTagName("details").length;

                for (var i = 0; i < len; i++) {
                    if (i != index) {
                        document.getElementsByTagName("details")[i].removeAttribute("open");
                    }
                }
            }
        </script>
    @endif
