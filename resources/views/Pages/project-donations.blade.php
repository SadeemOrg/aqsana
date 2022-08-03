@extends('layout.app')
@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2">
    <div class="flex flex-row">
        <ul class="list-reset breadcrumbs flex flex-row font-FlatBold ">
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#101426]">
                <a href="/">الرئيسية</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#101426]">
                <a href="/">التبرع بالمشاريع</a>
            </li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 ">/</li>
            <li class="ltr:mr-2 rtl:ml-2 ml-2 font-FlatBold text-[14px] text-[#349A37]">
                تبرع الان
            </li>
        </ul>
    </div>
    @include('Components.ProjectDonations.DonationSteps')
@include('Components.ProjectDonations.ProjectDonationsDetalis')


    {{-- <div class="mt-10 sm:mt-20 flex flex-col gap-y-6">
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <input type="text" name="" placeholder=" الاسم الاول"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <input type="text" name="" placeholder=" الاسم الاخير"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
        </div>
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <input type="text" name="" placeholder="رقم الهاتف"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <input type="text" name="" placeholder="رقم البطاقة"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
        </div>
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <input type="text" name="" placeholder="CVV"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <div dir="ltr" class="w-[80%] md:w-[50%]">
                <input datepicker type="text"
                    class="block w-full border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 text-right"
                    placeholder="MM/YY">
            </div>
        </div>
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <img src="assets/image/visa-images.png" alt="cards images">
        </div>
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <button
                class="rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">تبرع
                الان</button>
        </div>
    </div> --}}
</div>
@endsection
