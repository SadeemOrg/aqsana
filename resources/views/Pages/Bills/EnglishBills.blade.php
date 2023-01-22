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
    <!--English Bills -->
    <div dir="ltr" class="max-w-7xl  mx-auto sm:px-6 lg:px-8 px-8" id="printJS-table">
        <img class="sm:h-[250px] w-[90%] mt-1.5"
            src="https://media.discordapp.net/attachments/938405759996276806/1060518737767309342/iuktui.png?width=1440&height=302"
            alt="alaqsa Logo">
        <div class="flex sm:flex-row flex-col-reverse items-center justify-between relative">
            <div class="basis-1/2 hidden sm:flex flex-col  items-start">
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
            <div class="sm:hidden flex flex-col items-center justify-center w-full my-4 gap-y-2 mx-16">
                <div class="flex flex-row flex-wrap items-start w-full justify-around gap-x-2">
                    <p class=" mt-1 text-[17px] font-noto_Regular text-[#101426]">Association Id :
                        <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
                    </p>
                    <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">title :
                        <span class="font-FlatBold text-[#6B7280] mx-1 ">{{ $newaddress[0] }}</span>
                    </p>
                </div>
                <div class="flex flex-row flex-wrap items-start w-full justify-around gap-x-2 ">
                    <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">Telephone :
                        <span dir="ltr" class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                    </p>
                    <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">Email :
                        <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $email }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center mt-0">
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
            <p class="text-[18px] font-FlatBold text-[#101426]">account owner :</p>
            <span class="font-FlatBold text-[#6B7280]  text-[18px] text-right">
                {{ $Transaction->TelephoneDirectory->name }}
            </span>
        </div>
        <!-- table -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle ">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            @if ($PaymentType == 'Bank transfer')
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-left sm:pl-6">
                                                Pay way</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                date</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Bank</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Branch</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Account Id</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                        @foreach ($Transaction->Payment_type_details as $ChikPayment)
                                            @php
                                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                                            @endphp
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3  font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $PaymentType }} </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-gray-900 ">
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['bank_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['Branch_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['account_number'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-gray-900 ">
                                                    {{ $ChikPayment['attributes']['equivelant_amount'] }}
                                                    ₪</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                                المجموع الكلي :</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                                {{ $Transaction->equivelant_amount }} ₪</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'cash')
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-left sm:pl-6">
                                                Pay way</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                date</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                        <tr>
                                            <td class="whitespace-nowrap px-8 py-4  font-FlatBold text-base text-black">
                                                {{ $PaymentType }} </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $newDate[0] }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $Transaction->transact_amount }} ₪</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                                total summation :</td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                                {{ $Transaction->transact_amount }} ₪</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'Bank doubt')
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-left sm:pl-6">
                                                Pay way</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                date doubt</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Bank number</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Branch number</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                doubt Id</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                doubt amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                        @foreach ($Transaction->Payment_type_details as $ChikPayment)
                                            @php
                                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                                            @endphp
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{ $PaymentType }} </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChikPayment['attributes']['bank_number'] }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChikPayment['attributes']['Branch_number'] }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChikPayment['attributes']['account_number'] }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChikPayment['attributes']['Doubt_value'] }}₪</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                                total summation :</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                                {{ $Transaction->equivelant_amount }} ₪</td>
                                        </tr>
                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            @elseif($PaymentType == 'bit')
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-left sm:pl-6">
                                                Pay way</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                date</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                telephone Number</th>
                                            {{-- <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Branch</th> --}}
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                        @foreach ($Transaction->Payment_type_details as $ChikPayment)
                                            @php
                                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                                            @endphp
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $PaymentType }} </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChikPayment['attributes']['telephone'] }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $ChikPayment['attributes']['equivelant_amount'] }} ₪</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td> --}}
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                            <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-base">
                                                total summation :</td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">
                                                {{ $Transaction->equivelant_amount }} ₪</td>
                                        </tr>
                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div dir="rtl"
            class="flex flex-row-reverse flex-wrap items-center justify-around sm:justify-between mt-4 sm:mx-7 mb-6 ">
            <div dir="ltr">
                <p class=" mt-3 text-[18px] font-FlatBold text-[#101426]">sector name:
                    @if ($Transaction->Sectors != null)
                        <span class="font-FlatBold text-[#101426] mx-1 text-sm"> {{ $Transaction->Sectors->text }}</span>
                    @else
                        <span class="font-FlatBold text-[#101426] mx-1 text-sm"> مخرجات عامة</span>
                    @endif
                </p>
                @if ($Transaction->description != null)
                    <p class=" mt-3 text-[18px] font-FlatBold text-[#101426]">Notes :
                        <span class="font-FlatBold text-[#101426] mx-1 text-sm">{{ $Transaction->description }}</span>
                    </p>
                @endif
            </div>
            <button dir="ltr" id="printpagebutton" type="button" onclick="printpage()"
                class=" rounded-[50px] bg-[#349A37] text-white text-base w-28 py-4 mt-4 font-[700] hover:bg-[#101426] duration-200">
                طباعة
            </button>
        </div>
        <div class="relative flex flex-row items-center justify-center w-full -mt-14 ">
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
