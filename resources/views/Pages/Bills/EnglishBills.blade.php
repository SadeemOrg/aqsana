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
        <img class="sm:h-[200px] w-[90%] mt-1.5" src="{{ asset('/assets/image/iuktui.png') }}" alt="alaqsa Logo">
        <div class="flex sm:flex-row w-[90%] mx-auto  flex-col-reverse items-center justify-between relative">
            <div class="basis-1/2 hidden sm:flex flex-col  items-start">
                <p class=" mt-3 text-[17px] font-bold text-[#101426]">Association Id :
                    <span class="font-extralight text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
                </p>
                <p class="mt-1 text-[17px] font-bold text-[#101426]">title :
                    <span class="font-extralight text-[#6B7280] mx-1 ">{{ $newaddress[0] }}</span>
                </p>
                <p class="mt-1 text-[17px] font-bold text-[#101426]">Telephone :
                    <span dir="ltr" class="font-extralight text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                </p>
                <p class="mt-1 text-[17px] font-bold text-[#101426]">Email :
                    <span class="font-extralight text-[#6B7280] mx-1 text-sm">{{ $email }}</span>
                </p>
            </div>
            <div class="sm:hidden flex flex-col items-center justify-center w-full mt-8  my-4 gap-y-2 px-16">
                <div class="flex flex-col items-start w-full justify-center gap-y-2">
                    <p class=" text-[17px] font-noto_Regular text-[#101426]">Association Id :
                        <span class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
                    </p>
                    <p class="text-[17px] font-noto_Regular text-[#101426]">title :
                        <span
                            class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 text-sm">{{ $newaddress[0] }}</span>
                    </p>
                </div>
                <div class="flex flex-col items-start w-full justify-center gap-y-2 ">
                    <p class="text-[17px] font-noto_Regular text-[#101426]">Telephone :
                        <span dir="ltr"
                            class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                    </p>
                    <p class="mt-1 text-[17px] font-noto_Regular text-[#101426]">Email :
                        <span class="font-FlatBold text-[#101426] md:text-[#6B7280] mx-1 text-sm">{{ $email }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-start md:items-center mt-0 px-16 md:px-0">
            <p dir="ltr" class="">{{ $newDate[0] }}</p>
            @if ($type == 1)
                <p class="font-FlatBold text-[17px] text-[#101426] ">receipt voucher number
                    <span class="text-base">
                        F-{{ $Transaction->bill_number }}
                    </span>
                </p>
            @else
                <p class="font-FlatBold text-[17px] text-[#101426] ">Compensation Voucher number
                    <span class="text-base">
                        R-{{ $Transaction->bill_number }}
                    </span>
                </p>
            @endif
            @if ($original == 1)
                <p class="font-FlatBold text-[17px] text-[#101426] "> orginal Bill</p>
            @else
                <p class="font-FlatBold text-[17px] text-[#101426] ">Copy from orginal Bill</p>
            @endif
        </div>
        <div class="flex flex-col-reverse items-center mx-auto relative sm:flex-row w-[90%]">
            <p class="text-[18px] font-FlatBold text-[#101426]">account owner :</p>
            <span class="font-FlatBold text-[#6B7280]  text-[18px] text-right">
                @if ($Transaction->Payment_type == 5)
                    moneybox :
                    {{ $Transaction->description }}
                @else
                    {{ $Transaction->TelephoneDirectory->name }}
                @endif

            </span>
        </div>
        <!-- table -->
        <div class="px-4 mx-8 md:mx-auto w-[90%]">
            <div class="sm:flex sm:items-center">
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle ">
                        @if ($type == 1)
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
                                                    $ChickBillDate = date(
                                                        'd/m/Y',
                                                        strtotime($ChikPayment['attributes']['Date']),
                                                    );
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
                                                    $ChickBillDate = date(
                                                        'd/m/Y',
                                                        strtotime($ChikPayment['attributes']['Date']),
                                                    );
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
                                                    $ChickBillDate = date(
                                                        'd/m/Y',
                                                        strtotime($ChikPayment['attributes']['Date']),
                                                    );
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
                                @elseif($PaymentType == 'moneybox')
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
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $PaymentType }} : {{ $Transaction->description }} </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    @php
                                                        $ChickBillDate = date(
                                                            'd/m/Y',
                                                            strtotime($Transaction->transaction_date),
                                                        );
                                                    @endphp
                                                    {{ $ChickBillDate }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-FlatBold text-gray-900 sm:pl-6">
                                                    {{ $Transaction->equivelant_amount }}
                                                </td>
                                            </tr>

                                            <tr>
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
                        @else
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg md:border-0 border-2 border-black">
                                <table class="min-w-full divide-y divide-black md:divide-gray-300">
                                    <thead class="bg-[#349A37]">
                                        <tr class="">
                                            <th scope="col"
                                                class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-left sm:pl-6">
                                                refunding money method.</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Date</th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5  text-sm font-semibold text-white text-left">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-black md:divide-gray-200 bg-[#E4FFE585]">
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3  font-FlatBold text-black md:text-gray-900 sm:pl-6">
                                                {{ $Transaction->payment_reason }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                {{ explode(' ', $Transaction->transaction_date)[0] }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                                {{ $Transaction->equivelant_amount * -1 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 font-FlatBold text-black md:text-gray-900 ">
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-center font-FlatBold text-base">
                                                Total :</td>
                                            <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-center text-lg">
                                                {{ $Transaction->equivelant_amount * -1 }} ₪</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @if ($type == 1)
            <div dir="rtl"
                class="flex flex-row-reverse flex-wrap items-center justify-around sm:justify-between mt-4 sm:mx-7 mb-6 w-[90%] px-4">
                <div dir="ltr">
                    <p class=" mt-3 text-[18px] font-FlatBold text-[#101426]">sector name:
                        @if ($Transaction->Sectors != null)
                            <span class="font-FlatBold text-[#101426] mx-1 text-sm">
                                {{ $Transaction->Sectors->text }}</span>
                        @else
                            <span class="font-FlatBold text-[#101426] mx-1 text-sm"> مخرجات عامة</span>
                        @endif
                    </p>
                    <p class="  mt-3 text-[18px] font-FlatBold text-[#101426]">project :
                        <span
                            class="font-FlatBold text-[#101426] mx-1 text-sm">{{ $Transaction->project->project_name }}</span>
                    </p>
                    @if ($Transaction->payment_reason != null)
                        <p class="  mt-3 text-[18px] font-FlatBold text-[#101426]">payment reason:
                            <span
                                class="font-FlatBold text-[#101426] mx-1 text-sm">{{ $Transaction->payment_reason }}</span>
                        </p>
                    @endif
                    @if ($Transaction->description != null)
                        <p class=" mt-3 text-[18px] font-FlatBold text-[#101426]">Notes :
                            <span class="font-FlatBold text-[#101426] mx-1 text-sm">{{ $Transaction->description }}</span>
                        </p>
                    @endif
                </div>
            </div>
        @endif
        @if ($type == 1)
            <div class="relative flex flex-row items-center justify-end md:justify-center w-full -mt-14 ">
                <img class="w-[200px] h-[180px] md:w-[320px] md:h-[290px]" src="{{ asset('assets/image/-dc.png') }}"
                    alt="logo">
                <div class="absolute">
                    <img class="w-28 h-28 md:w-44 md:h-40" src="{{ asset('assets/image/-removebg-preview.png') }}"
                        alt="ttab">
                </div>
            </div>
            @else
            <div class="relative flex flex-row items-center justify-end md:justify-center w-full ">
                <img class="w-[200px] h-[180px] md:w-[320px] md:h-[290px]" src="{{ asset('assets/image/-dc.png') }}"
                    alt="logo">
                <div class="absolute">
                    <img class="w-28 h-28 md:w-44 md:h-40" src="{{ asset('assets/image/-removebg-preview.png') }}"
                        alt="ttab">
                </div>
            </div>
        @endif
    </div>
@endsection
