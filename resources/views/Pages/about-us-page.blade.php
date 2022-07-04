@extends('layout.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2">
    <div class="flex flex-row-reverse ">
        <ul class="list-reset breadcrumbs flex flex-row text-right w-full font-FlatBold ">
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#101426]">
                <a href="/">الرئيسية</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#349A37]">
                 من نحن
            </li>
        </ul>
    </div>
</div>
@include('Components.aboutUs.AboutUsComp')
@include('Components.aboutUs.OurVision')
@include('Components.aboutUs.OurGoals')
@include('Components.aboutUs.best_Achievements')
@include('Components.aboutUs.business_sectors')
@include('layout.front-end.partial.contact-us')
@endsection
