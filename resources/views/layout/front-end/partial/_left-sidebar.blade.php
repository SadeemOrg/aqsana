@if (!isset($left_SideBar) || (isset($left_SideBar) && $left_SideBar))
@php

    $img = 'storage/' . nova_get_setting('logo', 'default_value');
@endphp

<div dir="ltr" class="sticky top-3/4 z-40 cursor-pointer hidden_popUp" onclick="location.href='/sector/5'">
    <div class="relative ">
        <img class="hidden md:block absolute h-36 ml-4"
        src="{{ asset('assets/image/qawafelLogoCircle.png') }}"
            alt="">
        <img class="hidden md:block absolute h-[6.5rem] w-28 left-8 top-6"
            src="{{ asset('assets/image/QawafelLogo.png') }}"
            alt="">
        <h1 class="hidden md:block absolute left-40 text-[20px] top-12 text-white">مسيرة قوافل الاقصى</h1>
        <h1 class="hidden md:block absolute left-48 text-[20px] top-[77px]  font-Flatnormal text-white">أخبار وتقارير</h1>
       
        <div>
            <img class="block md:hidden "
            src="{{ asset('assets/image/QawafelLogo.png') }}"
            alt="logoooo">
        </div>
    </div>
</div>
@endif
