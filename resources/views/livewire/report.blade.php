<div>
    <form class="Wraper" wire:submit.prevent="searchWorkHours">
        <div class="">
            <p class="font-FlatBold text-xl sm:text-[22px] mt-8 lg:mt-0">ساعات عمل
                الموظفين</p>
            <div class="grid grid-cols-1 gap-3 md:gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4 ">
                <div class=" h-12">
                    <select pla wire:model="Name" name="name"
                        class="selectwhorkHour block w-full  text-[#349A37]  border-[#349A37] border rounded-[60px] sm:text-sm px-4 h-10 placeholder-[#349A37] ">
                        <option value="0" class="text-black"> اسم الموظف </option>
                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!--Date Picker -->
                <div dir="ltr" class="relative h-12">
                    <div
                        class="svgFoucusAdminFrom absolute inset-y-0 left-0 flex mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <input wire:model.debounce.50000ms="FromDate" id="hidePlaceHolderDateAdminFrom" type="text"
                        data-val-required="Mandatory field" data-val="true"
                        class="border-[#349A37] hidePlaceHolderDate  text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" من تاريخ" type="text" onblur="if(this.value==''){this.type='text'}"
                        onfocus="handelFocusAdminDateFrom()">
                </div>
                <!--to Date  -->
                <div dir="ltr" class="relative h-12">
                    <div
                        class="svgFoucusAdminTo absolute inset-y-0 left-0 flex mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden=" true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.debounce.50000ms="ToDate" id="hidePlaceHolderDateAdminTo" type="text"
                        class="border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" الى تاريخ" onfocus="handelFocusAdminDateTo()">
                </div>
                <!--end Picker -->
                <div class="flex w-full h-12">
                    <button type="submit"
                        class="mx-2 connectUs w-full duration-200 text-center px-5 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        بحث
                    </button>
                    <button wire:click="exportWorkHours" class="connectUs flex items-center justify-center w-full duration-200 text-center px-10 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        <svg class="min-w-[20px] min-h-[20px]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="20px" height="20px"><g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z"/></g></g></svg>
                        <span class="mr-2">تصدير pdf</span>
                    </button>


                </div>
            </div>
            <span class="text-red-500"> {!! $this->exportWorkHoursErorr !!}</span>

        </div>
    </form>


    <!--End Perosonal Information -->
    <!--from Date -->
    @if ($this->FromDate && $this->ToDate)
        <div class="mt-8 flex flex-row items-center justify-start gap-x-3">
            <p class="text-[#8A8B9F] text-sm ">من تاريخ : {{ $this->FromDate }}</p>
            <p class="text-[#8A8B9F] text-sm ">الى تاريخ :{{ $this->ToDate }}</p>

        </div>
    @endif

    <!--End Date -->
    <!--Start with Table -->
    <div class="px-4 sm:px-6 lg:px-8 mt-8">
        <div class="mt-8 flow-root">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    @if ($sortedArray)
                        <table class="min-w-full divide-y divide-gray-300 border-2">
                            <thead class="bg-gray-50">
                                <tr>

                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-right text-sm font-semibold text-[#349A37] ">
                                        اليوم</th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">
                                        التاريخ
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">ساعة
                                        البدء
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">ساعة
                                        الانتهاء</th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37] min-w-[150px]">
                                        عدد
                                        ساعات عملي</th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37] min-w-[150px]">
                                        ملاحضات
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 g-white">

                                @foreach ($sortedArray as $WorkHoursearch)
                                    @if ($WorkHoursearch['table'] == 'work_hours')
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426]">
                                                {{ $WorkHoursearch['day'] }}</td>
                                            @php
                                                // Assuming $WorkHoursearch['date'] is the date string
                                                $dateString = $WorkHoursearch['date'];

                                                // Convert the date string to a DateTime object
                                                $dateTime = new DateTime($dateString);

                                                // Format the DateTime object as 'd/m/Y'
                                                $formattedDate = $dateTime->format('d/m/Y');
                                            @endphp
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                                {{ $formattedDate }}</td>

                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                                {{ $WorkHoursearch['start_time'] }}</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                                {{ $WorkHoursearch['end_time'] }}</td>
                                            <td
                                                class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                                {{ $WorkHoursearch['day_hours'] }}
                                            </td>
                                        </tr>
                                    @elseif ($WorkHoursearch['table'] == 'vacations')
                                        <tr class="bg-red-500">
                                            <td
                                                class=" whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426]">
                                                {{ $WorkHoursearch['day'] }} </td>

                                            @php
                                                // Assuming $WorkHoursearch['date'] is the date string
                                                $dateString = $WorkHoursearch['date'];

                                                // Convert the date string to a DateTime object
                                                $dateTime = new DateTime($dateString);

                                                // Format the DateTime object as 'd/m/Y'
                                                $formattedDate = $dateTime->format('d/m/Y');
                                            @endphp
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                                {{ $formattedDate }}</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                                {{ $WorkHoursearch['type'] }}</td>


                                            <td
                                                class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">

                                                {{ $WorkHoursearch['note'] }}


                                            </td>
                                            <td
                                                class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">

                                            </td> <td
                                            class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">




                                        </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">

                                        مجموع ايام الدوام


                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">


                                        {{ $sumWorkHours }}

                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">

                                        مجموع ايام الاجازة



                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">



                                        {{ $sumVacation }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">




                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>


</div>
