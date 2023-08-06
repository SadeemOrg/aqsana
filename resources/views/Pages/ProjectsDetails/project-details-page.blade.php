@extends('layout.app')
@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2">
    <div class="flex flex-row">
        <ul class="list-reset breadcrumbs flex flex-row font-FlatBold ">
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-xs sm:text-[14px] text-[#101426]">
                <a target="_self" href="/">الرئيسية</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-xs sm:text-[14px] text-[#101426]">
                <a target="_self" href="/our-project">مشاريعنا</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-xs sm:text-[14px]  text-[#349A37]">
                مشروع إفطار الصائم في المسجد الاقصى
            </li>
        </ul>
    </div>
</div>

@include('Components.Projects.project-details')
@endsection
