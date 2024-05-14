<div>
    <form class="Wraper" wire:submit.prevent="searchWorkHours">
        <div class="">
            <p class="font-FlatBold text-xl sm:text-[22px] mt-8 lg:mt-0">ساعات عمل
                الموظفين</p>
            <div class="grid grid-cols-1 gap-3 md:gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4 ">
                <div class=" h-12">
                    <select pla wire:model.defer="Name" name="name"
                        class="selectwhorkHour block w-full  text-[#349A37]  border-[#349A37] border rounded-[60px] sm:text-sm px-4 h-10 placeholder-[#349A37] ">
                        <option value="0" class="text-black"> اسم الموظف </option>
                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                    <div class="text-red-600 text-sm px-2 text-right">
                        {{ $this->exportWorkHoursErorrUser }}
                    </div>
                </div>
                <!--Date Picker -->
                <div dir="ltr" class="relative h-12">
                    <div
                        class="svgFoucusAdminFrom absolute inset-y-0 hidden left-0 top-3 mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.defer="FromDate" id="hidePlaceHolderDateAdminFrom" type="text"
                        data-val-required="Mandatory field" data-val="true"
                        class="border-[#349A37] hidePlaceHolderDate  text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" من تاريخ" type="text" onblur="if(this.value==''){this.type='text'}"
                        onfocus="handelFocusAdminDateFrom()">
                        <div class="text-red-600 text-sm px-2 text-right">
                            {{ $this->exportWorkHoursErorrDate }}
                        </div>
                </div>
                <!--to Date  -->
                <div dir="ltr" class="relative h-12">
                    <div
                        class="svgFoucusAdminTo absolute inset-y-0 left-0 top-3 hidden  mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden=" true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.defer="ToDate" id="hidePlaceHolderDateAdminTo" type="text"
                        class="border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" الى تاريخ" onfocus="handelFocusAdminDateTo()">
                        <div class="text-red-600 text-sm px-2 text-right">
                            {{ $this->exportWorkHoursErorrType }}
                        </div>
                </div>
                <!--end Picker -->
                <div class="flex w-full h-12">
                    <button type="submit"
                        class="mx-2 connectUs w-full duration-200 text-center px-5 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        بحث
                    </button>
                    <button wire:click="exportWorkHours"
                        class="connectUs flex items-center justify-center w-full duration-200 text-center px-10 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        <svg class="min-w-[20px] min-h-[20px]" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="20px"
                            height="20px">
                            <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                style="mix-blend-mode: normal">
                                <g transform="scale(5.12,5.12)">
                                    <path
                                        d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z" />
                                </g>
                            </g>
                        </svg>
                        <span class="mr-2">تصدير xl</span>
                    </button>
                </div>
            </div>
            <span class="text-red-500 text-right text-base"> {!! $this->exportWorkHoursErorr !!}</span>

        </div>
    </form>

    <div class="grid grid-cols-1 gap-3 md:gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4">
        <button wire:click="showAddModels"
            class="connectUs duration-200 w-full px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] text-center hover:text-white ">اضافة</button>
    </div>


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
                    @if ($WorkHourssearch)
                        <table class="min-w-full divide-y divide-gray-300 border-2">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-right text-sm font-semibold text-[#349A37] ">
                                        اسم الموظف</th>
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
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">
                                        العمليات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 g-white">
                                @foreach ($WorkHourssearch as $WorkHoursearch)
                                    <tr>

                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                            {{-- {{ $dataaaa[0]['start_time'] }} --}}
                                            {{ $WorkHoursearch->user->name }}
                                        </td>

                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                            {{ $WorkHoursearch->day }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                            {{ date_format($WorkHoursearch->date, 'd/m/Y') }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                            {{ $WorkHoursearch->start_time }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                            {{ $WorkHoursearch->end_time }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                            {{ $WorkHoursearch->day_hours }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">

                                            <svg class="cursor-pointer"
                                                wire:click="showNoteModels({{ $WorkHoursearch->id }})" width="35"
                                                height="35" viewBox="0 0 35 35" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="35" height="35" rx="2" fill="#F7F7F7" />
                                                <rect x="6.25" y="6.36365" width="22.5" height="22.9091"
                                                    fill="url(#pattern0)" />
                                                <defs>
                                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                        width="1" height="1">
                                                        <use xlink:href="#image0_55_1538"
                                                            transform="matrix(0.00198864 0 0 0.00195312 -0.00909093 0)" />
                                                    </pattern>
                                                    <image id="image0_55_1538" width="512" height="512"
                                                        xlink:href="data:image/png;base64,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ABHxpbrc8RBgN1xSsB+wZuD2LMeV6T0deDvw3xYR8U53ACQvRgDHAWOB2fj91f8UbjdEKRfdAZBSUQIgedSD9usHlmBz/k7BJRna+riclABIqSgBkCLoj3tUcDHwJsnP20Ut/+2A0A2XTFECIKWiBECKaD3geNzrhzPo/HydD/wRWDdOMyVjlAB0QYsARSQP3myJy3GvG24N7IArZNQbV9/geeBeYE6cJorkixIAEcmbZtyivqdiN0Qkz7QwRkREpISUAIiIiJSQEgAREZESUgIgIiJSQkoARERESkgJgIiISAkpARARESkhJQAiIiIlpARARESkhJQAiIiIlJASABERkRJSAiAiIlJCSgBERERKSAmAiIhICSkBEBERKSElACIiIiWkBEBERKSElACIiIiUkBIAERGRElICICIiUkJKAEREREpICYCIiEgJKQEQEREpISUAIiIiJaQEQEREpISUAIiIiJSQEgAREZESUgIgIiJSQkoARERESkgJgIiISAkpARARESkhJQAiIiIl1CN2AyTzrm8JEREpEN0BEBERKSElACIiIiWkBEBERKSElACIiIiUkBIAERGRElICICIiUkJKAEREREpICYCIiEgJKQEQEREpISUAxTM3dgNERApqduwGWFICUDzvx26AiEhBTYndAEtKAIrnqdgNEBEpqELNrw2xGyDmegPTgH6xGyIiUjA7A4/FboQV3QEonoXAZbEbISJSMI8Bj8duhCXdASimgcArwJDYDRERKYClwEgKlgDoDkAxzQIOBhbFboiISAGcRsEu/qAEoMgeBfYHZsZuiIhITjUD3wYuid0QH5piN0C8mgj8FRgObBy3KSIiufIccARwY+yG+KI1AOWxLXAoMBpYC1g9bnNERDJlFu49/0eAW4E7gWVRW+TZ/wczGJ9NSZm60gAAAABJRU5ErkJggg==" />
                                                </defs>
                                            </svg>


                                        </td>
                                        <td
                                            class=" flex whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                            <div class="flex flex-row items-center gap-x-2">
                                                <svg class="cursor-pointer"
                                                    wire:click="showEditModels({{ $WorkHoursearch->id }})"
                                                    width="35" height="35" viewBox="0 0 56 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="56" height="55" rx="2"
                                                        fill="#F7F7F7" />
                                                    <g clip-path="url(#clip0_54_1525)">
                                                        <path
                                                            d="M31.5266 18.0388L15.0202 34.5464C14.9372 34.6297 14.8772 34.7349 14.8486 34.8479L13.0191 42.1915C12.9643 42.4125 13.0293 42.6476 13.1906 42.8089C13.3127 42.931 13.479 42.9986 13.6491 42.9986C13.7013 42.9986 13.7546 42.9921 13.8064 42.9791L21.15 41.1492C21.2644 41.1207 21.3684 41.061 21.4514 40.9779L37.9593 24.4715L31.5266 18.0388Z"
                                                            fill="#349A37" />
                                                        <path
                                                            d="M42.0487 15.7881L40.2112 13.9506C38.9832 12.7226 36.8428 12.7238 35.6162 13.9506L33.3655 16.2014L39.7979 22.6338L42.0487 20.3831C42.6621 19.7699 43 18.9537 43 18.0857C43 17.2176 42.6621 16.4015 42.0487 15.7881Z"
                                                            fill="#349A37" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_54_1525">
                                                            <rect width="30" height="30" fill="white"
                                                                transform="translate(13 13)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <svg class="cursor-pointer"
                                                    wire:click="Delete({{ $WorkHoursearch->id }})" width="35"
                                                    height="35" viewBox="0 0 56 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="56" height="55" rx="2"
                                                        fill="#F7F7F7" />
                                                    <path
                                                        d="M16.6448 19.7891L18.2016 38.5821C18.3132 39.9374 19.4676 41 20.828 41H35.1721C36.5325 41 37.6869 39.9374 37.7985 38.5821L39.3552 19.7891H16.6448ZM23.6047 37.4844C23.1446 37.4844 22.7575 37.1265 22.7283 36.6604L21.8494 22.4807C21.8194 21.9958 22.1876 21.5786 22.6717 21.5486C23.1738 21.5134 23.5729 21.8859 23.6038 22.3708L24.4827 36.5505C24.5138 37.0527 24.1165 37.4844 23.6047 37.4844ZM28.8789 36.6055C28.8789 37.0913 28.4858 37.4844 28 37.4844C27.5142 37.4844 27.1211 37.0913 27.1211 36.6055V22.4258C27.1211 21.94 27.5142 21.5469 28 21.5469C28.4858 21.5469 28.8789 21.94 28.8789 22.4258V36.6055ZM34.1506 22.4807L33.2717 36.6604C33.2428 37.1218 32.8583 37.5063 32.3396 37.4827C31.8555 37.4526 31.4873 37.0355 31.5173 36.5506L32.3962 22.3709C32.4263 21.886 32.8512 21.5332 33.3283 21.5486C33.8125 21.5787 34.1807 21.9958 34.1506 22.4807Z"
                                                        fill="#E92F30" />
                                                    <path
                                                        d="M39.4258 14.5156H34.1523V13.6367C34.1523 12.1828 32.9696 11 31.5156 11H24.4844C23.0304 11 21.8477 12.1828 21.8477 13.6367V14.5156H16.5742C15.6034 14.5156 14.8164 15.3026 14.8164 16.2734C14.8164 17.2442 15.6034 18.0312 16.5742 18.0312C24.6582 18.0312 31.3421 18.0312 39.4258 18.0312C40.3966 18.0312 41.1836 17.2442 41.1836 16.2734C41.1836 15.3026 40.3966 14.5156 39.4258 14.5156ZM32.3945 14.5156H23.6055V13.6367C23.6055 13.1518 23.9995 12.7578 24.4844 12.7578H31.5156C32.0005 12.7578 32.3945 13.1518 32.3945 13.6367V14.5156Z"
                                                        fill="#E92F30" />
                                                </svg>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                                <tr>

                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">


                                    </td>

                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                        مجموع الايام </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                        {{ $WorkHourssearch->count() }}

                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                        مجموع الساعات

                                    </td>

                                    @if ($WorkHourssearch->count() == 0)
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                            00:00:00
                                        </td>
                                    @else
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                            {{ ($sumWorkHourssearch->day - 1) * 24 + $sumWorkHourssearch->hour }}:{{ $sumWorkHourssearch->minute }}:{{ $sumWorkHourssearch->second }}
                                        </td>
                                    @endif
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]"></td>

                                </tr>

                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!--start reason popup Timer -->
    @if ($this->showEditModel == true)
        <div class=" popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-visible">
                <div
                    class="flex flex-col min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-xs sm:max-w-md sm:p-6">
                        <button>
                            <svg wire:click="closeEditModel" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <form class="Wraper2" wire:submit.prevent="EditDay">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">تعديل ساعات العمل </p>
                            <!--First One -->
                            <div class="mt-2 selectdiv">
                                <input type="text" wire:model.defer="date"
                                    class="hidePlaceHolderEditDatePopUp border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                                    placeholder="تاريخ" onfocus="handelFocusEditDatePopup()">
                            </div>
                            <div class="flex flex-row items-center flex-wrap sm:flex-nowrap justify-between">
                                <div class="mt-2 selectdiv w-1/2">
                                    <input type="text" placeholder="ساعة البدء" onfocus="handelInputtimeFrom()"
                                        wire:model.defer="start_time"
                                        class="foucsTimeStart h-12 bg-transparent border border-[#349A37] w-[180px] sm:w-[150px] text-[#349A37] text-sm text-right rounded-[15px] block  p-2.5 placeholder-[#349A37] ">
                                </div>
                                <div class="mt-2 selectdiv w-1/2">
                                    <input type="text" onfocus="handelInputtimeTo()" placeholder="ساعة الانتهاء"
                                        wire:model.defer="end_time"
                                        class="foucsTimeEnd h-12 bg-transparent border border-[#349A37] w-[180px] sm:w-[150px] text-[#349A37] text-sm text-right rounded-[15px] block  p-2.5 placeholder-[#349A37] ">
                                </div>
                            </div>

                            <div class="mt-2">
                                <button type="submit"
                                    class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                    تطبيق
                                </button>
                            </div>
                        </form>
                        <!--Endsecond Page -->
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--end reason popup Timer -->

    <!--start reason popup Timer -->
    @if ($this->showAddModel == true)
        <div class=" popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-visible">
                <div
                    class="flex flex-col min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-xs sm:max-w-md sm:p-6">
                        <button>
                            <svg wire:click="closeAddModel" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <form class="Wraper2" wire:submit.prevent="AddDay">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">اضافة ساعات العمل </p>
                            <!--First One -->
                            <div class="mt-2 selectdiv ">
                                <select wire:model.defer="ModelId" name="ModelId"
                                    class="h-12 text-[#349A37] w-full text-right border-[#349A37] border rounded-[60px] sm:text-base px-4 placeholder-[#349A37] ">
                                    <option class="text-black" value="0" disabled> اسم الموظف </option>
                                    @foreach ($users as $user)
                                        <option class="text-[#349A37] " value="{{ $user['id'] }}">
                                            {{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                                <div class="text-red-600 text-sm px-2 text-right">
                                    {!! $this->ModelIdErorrUser !!}
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 items-center flex-wrap sm:flex-nowrap justify-between">
                                <div class="mt-2 selectdiv w-full sm:w-1/2">
                                    <input type="text" placeholder="ساعة البدء" onfocus="handelInputtimeFrom()"
                                        wire:model.defer="start_time"
                                        class="foucsTimeStart h-12 bg-transparent border border-[#349A37] w-full text-[#349A37] text-sm text-right rounded-[60px] block  p-2.5 placeholder-[#349A37] ">
                                    <div class="text-red-600 text-sm px-2 text-right">
                                        {!! $this->startTimeErorr !!}
                                    </div>
                                </div>
                                <div class="sm:mt-2 selectdiv w-full sm:w-1/2">
                                    <input type="text" onfocus="handelInputtimeTo()" placeholder="ساعة الانتهاء"
                                        wire:model.defer="end_time"
                                        class="foucsTimeEnd h-12 bg-transparent border border-[#349A37] w-full text-[#349A37] text-sm text-right rounded-[60px] block  p-2.5 placeholder-[#349A37] ">

                                    <div class="text-red-600 text-sm px-2 text-right">
                                        {!! $this->endTimeWorkHoursErorr !!}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 selectdiv relative">
                                <input type="text" id="hidePlaceHolderDatePopUp" wire:model.defer="date"
                                    class="border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-[98%] p-2.5 placeholder-[#349A37]"
                                    placeholder="تاريخ" onfocus="handelFocusDatePopup()">
                                <div
                                    class="svgFoucusDatePopUp absolute hidden inset-y-0 left-5 top-3 mb-1 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden=" true" class="w-5 h-5 text-[#349A37] " fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-red-600 text-sm px-2 text-right">
                                    {!! $this->dateErorrUser !!}
                                </div>
                            </div>

                            <div class="mt-2">
                                <button type="submit"
                                    class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 mx-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                    تطبيق
                                </button>
                            </div>
                    </div>

                    </form>



                    <!--Endsecond Page -->
                </div>
            </div>
        </div>

    @endif
    <!--end reason popup Timer -->

    <!--start reason popup Timer -->
    @if ($this->showNoteModels == true)
        <div class=" popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 top-[3%] z-10 ">
                <div class="flex flex-col min-h-full justify-center p-4 text-center items-center sm:p-0">
                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                        <button>
                            <svg wire:click="closeNoteModels" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <form wire:submit.prevent="EditNote">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">تعديل الملحوظة </p>
                            <!--First One -->
                            {{-- {{$Notes  }} --}}
                            @if ($Notes)
                                @foreach ($Notes as $key => $Note)
                                    <div class="border-[#349A37] py-2 border-b-2">
                                        <div class="mt-2 selectdiv">
                                            <input wire:model.defer="notedate.{{ $key }}.Type"
                                                type="text" placeholder="سبب المغادرة"
                                                class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-full w-full  p-2.5 placeholder-[#349A37] ">
                                        </div>
                                        <div class="flex flex-row items-center justify-between">
                                            <div class="mt-2 selectdiv w-72">
                                                <input wire:model.defer="notedate.{{ $key }}.time_out"
                                                    type="text" placeholder="ساعة البدء"
                                                    onfocus="handelEditNotesInputtimeFrom()"
                                                    class="foucsEditTimeStart h-12 bg-transparent border border-[#349A37] w-[150px] text-[#349A37] text-sm text-right rounded-[15px] block  p-2.5 placeholder-[#349A37] ">
                                            </div>
                                            <div class="mt-2 selectdiv">
                                                <input wire:model.defer="notedate.{{ $key }}.return_time"
                                                    type="text" onfocus="handelInputEditNotestimeTo()"
                                                    placeholder="ساعة الانتهاء"
                                                    class="foucsEditTimeEnd h-12 bg-transparent border border-[#349A37] w-[150px] text-[#349A37] text-sm text-right rounded-[15px] block  p-2.5 placeholder-[#349A37] ">
                                            </div>
                                        </div>
                                        <div class="flex flex-row items-center justify-start gap-x-2 mt-2">
                                            <div class="basis-1/2">
                                                <button type="submit"
                                                    class="connectUs duration-200 w-full text-center px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                                    <div class="flex flex-row items-center gap-x-2">
                                                        <svg width="18" height="20" viewBox="0 0 35 34"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1238_666)">
                                                                <path
                                                                    d="M21.3028 5.67969L2.69553 24.2883C2.60191 24.3822 2.53432 24.5007 2.50213 24.6281L0.439695 32.9063C0.378002 33.1555 0.451229 33.4205 0.63309 33.6024C0.770693 33.74 0.958187 33.8161 1.14997 33.8161C1.20872 33.8161 1.2688 33.8089 1.32727 33.7941L9.60545 31.7314C9.73447 31.6993 9.85168 31.6319 9.9453 31.5383L28.5541 12.9311L21.3028 5.67969Z"
                                                                    fill="white" />
                                                                <path
                                                                    d="M33.164 3.14322L31.0928 1.07194C29.7084 -0.312409 27.2957 -0.311068 25.9129 1.07194L23.3757 3.60914L30.6268 10.8603L33.164 8.32305C33.8556 7.63181 34.2364 6.71178 34.2364 5.73327C34.2364 4.75476 33.8556 3.83472 33.164 3.14322Z"
                                                                    fill="white" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1238_666">
                                                                    <rect width="33.8182" height="33.8182"
                                                                        fill="white"
                                                                        transform="translate(0.418213)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        تعديل
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="basis-1/2">
                                                <div wire:click="DeleteNote({{ $key }})"
                                                    class="connectUs duration-200 w-full px-5 lg:px-10 py-3 mt-2 text-[13px] text-center border-[1px] border-[#E92F30] font-FlatBold rounded-[30px] text-[#E92F30] bg-transparent hover:bg-[#101426] hover:text-white ">
                                                    <div class="flex flex-row items-center gap-x-2">
                                                        <svg width="18" height="20" viewBox="0 0 35 34"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1238_671)">
                                                                <path
                                                                    d="M4.76318 9.90723L6.5181 31.0921C6.64386 32.6199 7.9452 33.8177 9.47877 33.8177H25.6484C27.182 33.8177 28.4833 32.6199 28.6091 31.0921L30.3639 9.90723H4.76318ZM12.6088 29.8547C12.0902 29.8547 11.6538 29.4512 11.6209 28.9258L10.6302 12.9414C10.5963 12.3948 11.0114 11.9246 11.5571 11.8907C12.1231 11.851 12.573 12.2709 12.6078 12.8176L13.5986 28.8019C13.6337 29.368 13.1858 29.8547 12.6088 29.8547ZM18.5543 28.8639C18.5543 29.4115 18.1112 29.8547 17.5636 29.8547C17.0159 29.8547 16.5728 29.4115 16.5728 28.8639V12.8795C16.5728 12.3319 17.0159 11.8888 17.5636 11.8888C18.1112 11.8888 18.5543 12.3319 18.5543 12.8795V28.8639ZM24.4969 12.9415L23.5062 28.9259C23.4736 29.4459 23.0401 29.8794 22.4554 29.8528C21.9097 29.8189 21.4947 29.3486 21.5285 28.802L22.5193 12.8176C22.5532 12.271 23.0321 11.8733 23.5701 11.8907C24.1158 11.9246 24.5308 12.3948 24.4969 12.9415Z"
                                                                    fill="#E92F30" />
                                                                <path
                                                                    d="M30.4436 3.96307H24.499V2.9723C24.499 1.33331 23.1657 0 21.5267 0H13.6006C11.9616 0 10.6283 1.33331 10.6283 2.9723V3.96307H4.68368C3.58928 3.96307 2.70215 4.8502 2.70215 5.9446C2.70215 7.03887 3.58928 7.92614 4.68368 7.92614C13.7965 7.92614 21.3311 7.92614 30.4436 7.92614C31.538 7.92614 32.4252 7.03887 32.4252 5.9446C32.4252 4.8502 31.538 3.96307 30.4436 3.96307ZM22.5175 3.96307H12.6098V2.9723C12.6098 2.42566 13.0539 1.98153 13.6006 1.98153H21.5267C22.0734 1.98153 22.5175 2.42566 22.5175 2.9723V3.96307Z"
                                                                    fill="#E92F30" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1238_671">
                                                                    <rect width="33.8182" height="33.8182"
                                                                        fill="white"
                                                                        transform="translate(0.654541)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>

                                                        حذف
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex flex-row items-center justify-center">
                                    <p class="text-2xl mt-4 text-[#349A37]">لا يوجد اي ملاحظات للتعديل </p>
                                </div>
                            @endif

                        </form>
                        <!--Endsecond Page -->
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
