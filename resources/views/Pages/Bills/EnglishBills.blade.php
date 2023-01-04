@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false, 'left_SideBar' => false])
@section('content')
    @php
        $society_id = nova_get_setting('society_id', '580179794');
        $phone = nova_get_setting('phone', 'default_value');
        $email = nova_get_setting('email', 'default_value');
        $address = nova_get_setting('address', 'default_value');
        $newaddress = explode(',', $address);
        $newDate = explode(' ', $Transaction->transaction_date);
        // dd($Donations->amount);
    @endphp
    <!--English Bills -->
    <div dir="ltr" class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-14 px-8" id="printJS-table">
        <div class="flex sm:flex-row flex-col-reverse items-center justify-between mt-24 relative">
            <div class="basis-1/2 flex flex-col items-center sm:items-start">
                <h3 class="mt-8 text-2xl font-FlatBold text-[#101426]">Al-Aqsa Organization</h3>
                <p class="mt-2 text-[17px] font-FlatBold text-center  text-[#6B7280]">Al-Aqsa Association for the Care of
                    Endowments and Islamic Sanctuaries</p>
                <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">Association Id :
                    <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
                </p>
                <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">title :
                    <span class="font-FlatBold text-[#6B7280] mx-1 ">{{ $newaddress[0] }}</span>
                </p>
                <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">Telephone :
                    <span dir="ltr" class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                </p>
                <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">Email :
                    <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $email }}</span>
                </p>
            </div>
            <div class="flex basis-1/2 justify-center">
                <img src="{{ asset('assets/image/2SG4XFNXK4WfehAE1eroA7kp7Y341RMs8f4ObPLO.png') }}" class="w-48 h-48 "
                    alt="">
            </div>
            <div class="lg:block hidden absolute right-[9%] xl:right-[15%] -bottom-[70%]">
                <svg width="280" height="150" viewBox="0 0 355 178" fill="none" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect width="355" height="178" fill="url(#pattern0)" />
                    <defs>
                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_201_4" transform="scale(0.0028169 0.00561798)" />
                        </pattern>
                        <image id="image0_201_4" width="355" height="178"
                            xlink:href="data:image/png;base64,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" />
                    </defs>
                </svg>
            </div>
        </div>
        <div class="lg:hidden flex flex-row items-center sm:justify-end justify-center my-4" class="w-[250px] h-[150px]">
            <img class="w-[250px]"
                src="https://cdn.discordapp.com/attachments/938405759996276806/1060265631393513472/-01_2.png"
                alt="">
        </div>
        <div class="flex flex-col items-center mt-10">
            <p dir="ltr" class="">{{ $newDate[0] }}</p>
            <p class="font-FlatBold text-[17px] text-[#101426] ">receipt voucher number
                <span class="text-base">
                    F-1000{{ $Transaction->id }}
                </span>
            </p>
            @if ($original == 1)
                <p class="font-FlatBold text-[17px] text-[#101426] "> orginal Bill</p>
            @else
                <p class="font-FlatBold text-[17px] text-[#101426] ">Copy from orginal Bill</p>
            @endif
        </div>
        <div class="flex flex-row items-center xl:justify-start justify-start gap-x-4 max-w-xl mt-4">
            <p class="text-[18px] font-FlatBold text-[#101426]">لحساب :</p>
            <span class="font-FlatBold text-[#6B7280]  text-[18px] text-right">
                {{ $Transaction->TelephoneDirectory->name }}
            </span>
        </div>
        <p class="font-FlatBold text-[#101426] mt-3 text-[17px]">pay done by:
            <span class="font-FlatBold text-[#6B7280] mx-1 text-[19px]">{{ $Transaction->name }} </span>
        </p>
        <!-- table -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle ">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-[#349A37]">
                                    <tr class="">
                                        <th scope="col"
                                            class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-left sm:pl-6">
                                            Pay way</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                            date</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                            Bank</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                            Branch</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                            Account Id</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                            Receipt Voucher number</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                            total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            Account </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $newDate[0] }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">12
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">632
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">161479
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            00120006</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $Transaction->transact_amount }} ₪</td>
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                            total summation :</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                            {{ $Transaction->transact_amount }} ₪</td>
                                    </tr>
                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row items-center justify-start mx-1 mb-6 relative">
            <button type="button" onclick="window.print()"
                class=" rounded-[50px] bg-[#349A37] text-white text-base w-28 py-4 mt-4 font-[700] hover:bg-[#101426] duration-200">
                Print
            </button>
            <div class="absolute right-[7%] top-2">
                <img class="w-20 h-20"
                    src="https://media.discordapp.net/attachments/938405759996276806/1060191298168049764/1.png"
                    alt="ttab">

            </div>
        </div>
    </div>
@endsection
