@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline ">
        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="var(--sidebar-icon)"
                d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z" />
        </svg>


        <span class="sidebar-label">{{ __('Resources') }}</span>
    </h3>

    @foreach ($navigation as $group => $resources)
        <details class="mr-2" >


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
@endif


