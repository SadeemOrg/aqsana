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
    class="flex items-center font-normal text-white mb-6 text-base no-underline cursor-pointer hover:text-black	 ">
    <?xml version="1.0" standalone="no"?>
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
    <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.5 0.000976562C5.59716 0.000976562 0 5.59729 0 12.501C0 19.4047 5.59661 25.001 12.5 25.001C19.4039 25.001 25 19.4047 25 12.501C25 5.59729 19.4039 0.000976562 12.5 0.000976562ZM12.5 3.73862C14.7841 3.73862 16.635 5.59015 16.635 7.87326C16.635 10.1569 14.7841 12.0079 12.5 12.0079C10.217 12.0079 8.36609 10.1569 8.36609 7.87326C8.36609 5.59015 10.217 3.73862 12.5 3.73862ZM12.4973 21.7328C10.2192 21.7328 8.13274 20.9031 6.52343 19.5299C6.1314 19.1955 5.90519 18.7051 5.90519 18.1906C5.90519 15.8751 7.77914 14.022 10.0951 14.022H14.906C17.2225 14.022 19.0893 15.8751 19.0893 18.1906C19.0893 18.7057 18.8642 19.1949 18.4716 19.5293C16.8629 20.9031 14.7759 21.7328 12.4973 21.7328Z" fill="#B2C0D0"/>
        </svg>
        

    <span class="sidebar-label m-2 "   onclick="location.href='/Admin/userprofile'">{{ __('profile') }}</span>
</h3>
@if (\Laravel\Nova\Nova::availableDashboards(request()))
    <ul class="list-reset mb-8">
        @foreach (\Laravel\Nova\Nova::availableDashboards(request()) as $dashboard)
            <li class="leading-wide mb-4 ml-8 text-sm ">
                <router-link
                    :to='{
                        name: "dashboard.custom",
                        params: {
                            name: "{{ $dashboard::uriKey() }}",
                        },
                        query: @json($dashboard->meta()),
                    }'
                    exact class="text-white no-underline dim hover:text-black">
                    {{ $dashboard::label() }}
                </router-link>
            </li>
        @endforeach
    </ul>
@endif
