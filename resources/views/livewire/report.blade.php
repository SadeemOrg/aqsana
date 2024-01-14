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
