<dropdown-trigger class="h-9 flex items-center">
    @isset($user->email)
        <img src="https://secure.gravatar.com/avatar/{{ md5(\Illuminate\Support\Str::lower($user->email)) }}?size=512"
            class="rounded-full w-8 h-8 mr-3" />
    @endisset

    <span class="text-90">
        {{ $user->name ?? ($user->email ?? __('Nova User')) }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <h3
                class=" block no-underline text-90 hover:bg-30 p-3 text flex items-center font-normal text-white  text-base no-underline cursor-pointer hover:text-black	 ">
                <?xml version="1.0" standalone="no"?>
                <!DOCTYPE svg
                    PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
                <svg width="20" height="20" viewBox="0 0 25 25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.5 0.000976562C5.59716 0.000976562 0 5.59729 0 12.501C0 19.4047 5.59661 25.001 12.5 25.001C19.4039 25.001 25 19.4047 25 12.501C25 5.59729 19.4039 0.000976562 12.5 0.000976562ZM12.5 3.73862C14.7841 3.73862 16.635 5.59015 16.635 7.87326C16.635 10.1569 14.7841 12.0079 12.5 12.0079C10.217 12.0079 8.36609 10.1569 8.36609 7.87326C8.36609 5.59015 10.217 3.73862 12.5 3.73862ZM12.4973 21.7328C10.2192 21.7328 8.13274 20.9031 6.52343 19.5299C6.1314 19.1955 5.90519 18.7051 5.90519 18.1906C5.90519 15.8751 7.77914 14.022 10.0951 14.022H14.906C17.2225 14.022 19.0893 15.8751 19.0893 18.1906C19.0893 18.7057 18.8642 19.1949 18.4716 19.5293C16.8629 20.9031 14.7759 21.7328 12.4973 21.7328Z"
                        fill="#B2C0D0" />
                </svg>


                <span class="block no-underline text-90 hover:bg-30 p-3"
                    onclick="location.href='/Admin/userprofile'">{{ __('profile') }}</span>
            </h3>

        </li>
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>

        </li>
    </ul>
</dropdown-menu>
