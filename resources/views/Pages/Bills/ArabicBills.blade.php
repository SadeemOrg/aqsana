@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false, 'left_SideBar' => false])
@section('content')
    @php

        $society_id = nova_get_setting('society_id', '580179794');
        $phone = nova_get_setting('phone', 'default_value');
        $email = nova_get_setting('email', 'default_value');
        $address = nova_get_setting('address', 'default_value');
        $newaddress = explode(',', $address);
        $newDate = explode(' ', $Transaction->transaction_date);
    @endphp
    <!--Arabic Bills -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-14 px-2" id="printJS-table">
        <div class="flex flex-row items-center justify-center mx-8 mt-12">
            <img class="sm:h-[170px] w-[90%]"
                src="https://media.discordapp.net/attachments/938405759996276806/1060518737767309342/iuktui.png?width=1440&height=302"
                alt="alaqsa Logo">
        </div>
        <div class="flex sm:flex-row flex-col-reverse items-center justify-between ">
            <div class="basis-1/2 hidden sm:flex flex-col  items-start">
                <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">رقم الجمعية :
                    <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
                </p>
                <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">العنوان :
                    <span class="font-FlatBold text-[#6B7280] mx-1 ">{{ $newaddress[0] }}</span>
                </p>
                <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">رقم الهاتف :
                    <span dir="ltr" class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                </p>
                <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">البريد الالكتروني :
                    <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $email }}</span>
                </p>
            </div>
<<<<<<< HEAD
            <div class="sm:hidden flex flex-col items-center justify-center w-full mt-8  my-4 gap-y-2 px-16">
                <div class=" flex flex-col items-center w-full justify-center gap-y-2">
                    <p class="  text-[17px] font-noto_Regular text-[#101426]">رقم الجمعية :
                        <span class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
=======
            <div class="sm:hidden flex flex-col items-center justify-between w-full my-4 gap-y-2 px-4">
                <div class="flex flex-row flex-wrap items-center w-full justify-between gap-x-6">
                    <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">رقم الجمعية :
                        <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
>>>>>>> 6b413e6a0b71f9df3d441a1dad53e7f727a72f65
                    </p>
                    <p class=" text-[17px] font-noto_Regular text-[#101426]">العنوان :
                        <span class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 ">{{ $newaddress[0] }}</span>
                    </p>
                </div>
                <div class=" flex flex-col items-center w-full justify-center gap-y-2 ">
                    <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">رقم الهاتف :
                        <span class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                    </p>
                    <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">البريد الالكتروني :
                        <span class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 ">{{ $email }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center mt-10">
            <p dir="ltr" class="">{{ $newDate[0] }}</p>
            <p class="font-FlatBold text-[17px] text-[#101426] ">سند قبض رقم
                <span class="text-base">
                    F-1000{{ $Transaction->id }}
                </span>
            </p>
            @if ($original == 1)
                <p class="font-FlatBold text-[17px] text-[#101426] "> النسخة ألاصلية</p>
            @else
                <p class="font-FlatBold text-[17px] text-[#101426] ">نسحة عن النسخة ألاصلية</p>
            @endif
        </div>
        <div class="flex flex-row items-center xl:justify-start justify-start gap-x-4 max-w-xl mt-4">
            <p class="text-[18px] font-FlatBold text-[#101426]">لحساب :</p>

            <span class="font-FlatBold text-[#101426] md:text-[#6B7280]  text-[18px] text-right">

                @if ($Transaction->Payment_type == 5)
                    حصالة رقم:
                    {{ $Transaction->Alhisalat->number_alhisala }}
                @else
                    {{ $Transaction->TelephoneDirectory->name }}
                @endif
            </span>
        </div>
        <!-- table -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
            </div>
            <div class="mt-8 flex  flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8  ">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-0">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg md:border-0 border-2 border-black">
                            @if ($PaymentType == 'حوالة مصرفية')
                                <table class="min-w-full divide-y divide-black md:divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-right sm:pl-6">
                                                طريقة الدفع</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                التاريخ</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                البنك</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                الفرع</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                رقم الحساب</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-black md:divide-gray-200 bg-[#E4FFE585]">
                                        @foreach ($Transaction->Payment_type_details as $ChikPayment)
                                            @php
                                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                                            @endphp
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3  font-FlatBold text-black md:text-gray-900 sm:pl-6">
                                                    {{ $PaymentType }} </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['bank_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['Branch_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['account_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['equivelant_amount'] }}
                                                    ₪</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                                المجموع الكلي :</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                                {{ $Transaction->equivelant_amount }} ₪</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'كاش')
                                <table class="min-w-full divide-y md:divide-gray-200 divide-black">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right w-48">
                                                تم الدفع من خلال :</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                التاريخ :</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-center">
                                                المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-black md:divide-gray-200 bg-[#E4FFE585]">
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base text-black md:text-gray-500">
                                                {{ $PaymentType }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500">
                                                {{ $newDate[0] }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-black md:text-gray-500">
                                                {{ $Transaction->transact_amount }} ₪</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-center font-FlatBold text-base">
                                                المجموع الكلي :</td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-center text-lg">
                                                {{ $Transaction->transact_amount }} ₪</td>
                                        </tr>
                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'شك')
                                <table class="min-w-full divide-y divide-black md:divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-right sm:pl-6">
                                                طريقة الدفع</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                تاريخ الشك</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                رقم البنك</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                رقم الفرع</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                رقم الحساب</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                قيمة الشك</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                        @foreach ($Transaction->Payment_type_details as $ChikPayment)
                                            @php
                                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                                            @endphp
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3  font-FlatBold text-black md:text-gray-900 sm:pl-6">
                                                    {{ $PaymentType }} </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['bank_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['Branch_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['account_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['Doubt_value'] }}₪
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                                المجموع الكلي :</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-black md:text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                                {{ $Transaction->equivelant_amount }} ₪</td>
                                        </tr>
                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'بيت')
                                <table class="min-w-full divide-y divide-black md:divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right w-48">
                                                تم الدفع من خلال :</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                التاريخ :</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                رقم الهاتف :</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-center">
                                                المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                        @foreach ($Transaction->Payment_type_details as $ChikPayment)
                                            @php
                                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                                            @endphp
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4  font-FlatBold text-base text-black-900">
                                                    {{ $PaymentType }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 font-FlatBold text-base text-black-900">
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 font-FlatBold text-base text-black-900">
                                                    {{ $ChikPayment['attributes']['telephone'] }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-center font-FlatBold text-base text-black-900">
                                                    {{ $ChikPayment['attributes']['equivelant_amount'] }} ₪
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-center font-FlatBold text-base">
                                                المجموع الكلي :</td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-center text-lg">
                                                {{ $Transaction->equivelant_amount }} ₪</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'حصالة')
                                <table class="min-w-full divide-y divide-black md:divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right w-48">
                                                تم الدفع من خلال :</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                                التاريخ :</th>

                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-center">
                                                المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">

                                        <tr>
                                            <td
                                                class="whitespace-nowrap px-3 py-4  font-FlatBold text-base text-black md:text-black-900">
                                                {{ $Transaction->Alhisalat->number_alhisala }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-base text-black md:text-black-900">
                                                @php
                                                    $ChickBillDate = date('d/m/Y', strtotime($Transaction->transaction_date));
                                                @endphp
                                                {{ $ChickBillDate }}
                                            </td>

                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-center font-FlatBold text-base text-black md:text-black-900">
                                                {{ $Transaction->transact_amount }} ₪
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                            </td>

                                            <td class="whitespace-nowrap px-3 py-4 text-center font-FlatBold text-base">
                                                المجموع الكلي :</td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-center text-lg">
                                                {{ $Transaction->transact_amount }} ₪</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row flex-wrap items-center md:justify-between justify-between px-4 mt-4 sm:mx-0 mb-6 ">
            <div>
                <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">اسم القطاع:
                    @if ($Transaction->Sectors != null)
                        <span class="font-FlatBold text-[#101426] mx-1 text-sm"> {{ $Transaction->Sectors->text }}</span>
                    @else
                        <span class="font-FlatBold text-[#101426] mx-1 text-sm"> مخرجات عامة</span>
                    @endif
                </p>
                @if ($Transaction->description != null)
                    <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">ملاحظات :
                        <span class="font-FlatBold text-[#101426] mx-1 text-sm">{{ $Transaction->description }}</span>
                    </p>
                @endif
            </div>
            <button dir="ltr" id="printpagebutton" type="button" onclick="printpage()"
                class=" rounded-[50px] bg-[#349A37] text-white text-base w-28 py-4 mt-4 font-[700] hover:bg-[#101426] duration-200">
                طباعة
            </button>
        </div>



        <div class="relative flex flex-row items-center justify-end w-full -mt-12">
            <img class="w-[280px] h-[240px]"
                src="https://cdn.discordapp.com/attachments/938405759996276806/1060512666013138975/-dc.png"
                alt="logo">
            <div class="absolute">
                <img class="w-36 h-36"
                    src="https://media.discordapp.net/attachments/938405759996276806/1060513822194028595/-removebg-preview.png"
                    alt="ttab">
            </div>
        </div>

    </div>
@endsection
