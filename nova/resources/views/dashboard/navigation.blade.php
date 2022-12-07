<router-link exact tag="h3"
    :to="{
        name: 'dashboard.custom',
        params: {
            name: 'main'
        }
    }"
    class="cursor-pointer flex items-center font-normal dim text-white mb-8 text-base no-underline">
    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 0 20 20">
        <defs>
            <path id="b"
                d="M11 18v-5H9v5c0 1.1045695-.8954305 2-2 2H4c-1.1045695 0-2-.8954305-2-2v-7.5857864l-.29289322.2928932c-.39052429.3905243-1.02368927.3905243-1.41421356 0-.3905243-.3905243-.3905243-1.02368929 0-1.41421358l9-9C9.48815536.09763107 9.74407768 0 10 0c.2559223 0 .5118446.09763107.7071068.29289322l9 9c.3905243.39052429.3905243 1.02368928 0 1.41421358-.3905243.3905243-1.0236893.3905243-1.4142136 0L18 10.4142136V18c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2zm5 0V8.41421356l-6-6-6 6V18h3v-5c0-1.1045695.8954305-2 2-2h2c1.1045695 0 2 .8954305 2 2v5h3z" />
            <filter id="a" width="135%" height="135%" x="-17.5%" y="-12.5%"
                filterUnits="objectBoundingBox">
                <feOffset dy="1" in="SourceAlpha" result="shadowOffsetOuter1" />
                <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="1" />
                <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.166610054 0" />
            </filter>
        </defs>
        <g fill="none" fill-rule="evenodd">
            <use fill="#000" filter="url(#a)" xlink:href="#b" />
            <use fill="var(--sidebar-icon)" xlink:href="#b" />
        </g>
    </svg>
    <span class="text-white sidebar-label">{{ __('Dashboard') }}</span>
</router-link>

<h3
    class="flex items-center font-normal text-white mb-6 text-base no-underline 	 ">
    <?xml version="1.0" standalone="no"?>
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
    <svg class="cursor-pointer" version="1.0" xmlns="http://www.w3.org/2000/svg" width="20.000000pt" height="20.000000pt"
        viewBox="0 0 24.000000 24.000000" preserveAspectRatio="xMidYMid meet">

        <g transform="translate(0.000000,24.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
            <path d="M90 195 c-15 -18 -10 -45 13 -59 34 -22 73 27 47 59 -16 19 -44 19
    -60 0z" />
            <path
                d="M105 89 c-4 -6 -14 -8 -22 -5 -22 9 -53 -12 -53 -34 0 -18 7 -20 90
    -20 83 0 90 2 90 20 0 22 -31 43 -53 34 -8 -3 -18 -1 -22 5 -8 14 -22 14 -30
    0z" />
        </g>
    </svg>

    <span class="sidebar-label m-2 cursor-pointer"   onclick="location.href='/Admin/userprofile'">{{ __('profile') }}</span>
</h3>
@if (\Laravel\Nova\Nova::availableDashboards(request()))
    <ul class="list-reset mb-8">
        @foreach (\Laravel\Nova\Nova::availableDashboards(request()) as $dashboard)
            <li class="leading-wide mb-4 ml-8 text-sm">
                <router-link
                    :to='{
                        name: "dashboard.custom",
                        params: {
                            name: "{{ $dashboard::uriKey() }}",
                        },
                        query: @json($dashboard->meta()),
                    }'
                    exact class="text-white no-underline dim">
                    {{ $dashboard::label() }}
                </router-link>
            </li>
        @endforeach
    </ul>
@endif
