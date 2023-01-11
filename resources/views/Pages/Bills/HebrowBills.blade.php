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
    <!--Hebrow Bills -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-14 px-2" id="printJS-table">
        <img class="h-[250px] w-full"
        src="https://media.discordapp.net/attachments/938405759996276806/1060518737767309342/iuktui.png?width=1440&height=302"
        alt="alaqsa Logo">
        <div class="flex sm:flex-row flex-col-reverse items-center justify-between ">
            <div class="basis-1/2">
                <h3 class="mt-8 text-4xl font-FlatBold text-[#101426]">ארגון אקצא</h3>
                <p class="mt-2 text-[19px] font-noto_Regular text-[#6B7280]">לפתח את נכסי ההקדש האיסלאמי</p>
                <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">אִרגוּן :
                    <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $society_id }}</span>
                </p>
                <p class=" text-[17px] font-noto_Regular text-[#101426]">כותרת :
                    <span class="font-FlatBold text-[#6B7280] mx-1 ">{{ $newaddress[0] }}</span>
                </p>
                <p class=" text-[17px] font-noto_Regular text-[#101426]">טלפון :
                    <span dir="ltr" class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $phone }}</span>
                </p>
                <p class=" text-[17px] font-noto_Regular text-[#101426]">אימייל
                    <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">{{ $email }}</span>
                </p>
            </div>
        </div>
        <div class="flex flex-col items-center mt-10">
            <p dir="ltr" class="">{{ $newDate[0] }}</p>
            <p class="font-FlatBold text-[20px] text-[#101426] ">קבלה מספר
                <span class="text-base">
                    F-1000{{ $Transaction->id }}
                </span>
            </p>
            @if ($original == 1)
                <p class="font-FlatBold text-[20px] text-[#101426] ">קבלה מקורית</p>
            @else
                <p class="font-FlatBold text-[20px] text-[#101426] ">עותק קשיח של המקור</p>
            @endif
        </div>
        <div class="flex flex-row items-center xl:justify-start justify-start gap-x-4 max-w-xl mt-4">
            <p class="text-[18px] font-FlatBold text-[#101426]">لحساب :</p>
            <span class="font-FlatBold text-[#6B7280]  text-[18px] text-right">
                {{ $Transaction->TelephoneDirectory->name }}
            </span>
        </div>
        <p class="font-FlatBold text-[#101426] mt-3 text-[22px]">התשלום בוצע דרך :
            <span class="font-FlatBold text-[#6B7280] mx-1 text-[19px]">{{ $PaymentType }} </span>
        </p>


        <!-- table -->

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-[#349A37]">
                                    <tr class="">
                                        <th scope="col"
                                            class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-right sm:pl-6">
                                            שיטות תשלום</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            תאריך</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            בַּנק</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            בַּנק</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            מספר חשבון</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            מס מחיה</th>
                                        <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">
                                            סך הכל</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            חשבון</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $newDate[0] }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">12</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">632</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">161479</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">00120006</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $Transaction->transact_amount }} ₪</td>
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                                        <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-lg">סך הכל סופי :</td>
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
        <div class="flex flex-col sm:flex-row items-center justify-start sm:justify-between mt-4 sm:mx-7 mb-6 ">
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
            <button dir="ltr" type="button" onclick="window.print()"
                class=" rounded-[50px] bg-[#349A37] text-white text-base w-28 py-4 mt-4 font-[700] hover:bg-[#101426] duration-200">
                طباعة
            </button>
        </div>
        <div class="relative flex flex-row items-center justify-center w-full -mt-12 ">
            <img class="w-[280px] h-[240px]"
                src="https://cdn.discordapp.com/attachments/938405759996276806/1060512666013138975/-dc.png" alt="logo">
            <div class="absolute">
                <img class="w-36 h-36"
                    src="https://media.discordapp.net/attachments/938405759996276806/1060513822194028595/-removebg-preview.png"
                    alt="ttab">
            </div>
        </div>

    </div>
@endsection
