@php
    $img = 'storage/' . nova_get_setting('logo', 'default_value');
    // dd($lastnews);
@endphp
<ul class="lateral-social-list list-none z-5 fixed m-0 p-0 rounded-2xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.7)]	">
    <li class="mb-4 flex flex-row items-center w-full justify-center ">
        <a target="_self" href="/">
            <img class="w-32 h-[100px]" src="https://media.discordapp.net/attachments/938405759996276806/1041691394949005352/Screenshot_2022-11-14_142923.png" />
        </a>
    </li>
    @if ($lastnews->count() > 0)
        @foreach ($lastnews as $news)
            <li class="mb-4 flex flex-row items-center w-full justify-center">
                <a href="/" class="cursor-pointer text-white text-[16px] pt-4 text-center max-w-none pl-4 h-[88px]">
                    {{Illuminate\Support\Str::limit($news->title,53) }}
                </a>
            </li>
        @endforeach
    @endif
</ul>
