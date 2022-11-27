@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
<h3   onclick="location.href='/userprofile'" class="flex items-center font-normal text-white mb-6 text-base no-underline ">
    <?xml version="1.0" standalone="no"?>
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
     "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="20.000000pt" height="20.000000pt" viewBox="0 0 24.000000 24.000000"
     preserveAspectRatio="xMidYMid meet">

    <g transform="translate(0.000000,24.000000) scale(0.100000,-0.100000)"
    fill="#000000" stroke="none">
    <path d="M90 195 c-15 -18 -10 -45 13 -59 34 -22 73 27 47 59 -16 19 -44 19
    -60 0z"/>
    <path d="M105 89 c-4 -6 -14 -8 -22 -5 -22 9 -53 -12 -53 -34 0 -18 7 -20 90
    -20 83 0 90 2 90 20 0 22 -31 43 -53 34 -8 -3 -18 -1 -22 5 -8 14 -22 14 -30
    0z"/>
    </g>
    </svg>

  <span class="sidebar-label m-2">{{ __('profile') }}</span>
</h3>

    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline ">
        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="var(--sidebar-icon)"
                d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z" />
        </svg>


        <span     class="sidebar-label">{{ __('Resources') }}</span>
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
              @foreach ($navigation as $group => $resources)
        <details class="mr-2"  onclick="closeAll(thisindex(this));">


            @if (count($groups) > 1)

                <summary style="line-height: 2rem/* 40px */; font-weight: 700;"  class="ml-8 mb-4 text-base text-white uppercase tracking-wide ">

                    {{ $group }}
                </summary>
            @endif

            <ul class="list-reset mb-8 mr-3">
                @foreach ($resources as $resource)
                    <li class="leading-tight mb-4 ml-12  text-sm">
                        <router-link
                            :to="{
                                name: 'index',
                                params: {
                                    resourceName: '{{ $resource::uriKey() }}'
                                }
                            }"
                            class="text-white text-justify no-underline dim"
                            dusk="{{ $resource::uriKey() }}-resource-link">
                            {{ $resource::label() }}
                        </router-link>
                    </li>
                @endforeach
            </ul>
        </details>
    @endforeach
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
