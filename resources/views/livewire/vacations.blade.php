<div>
    <form class="Wraper" wire:submit.prevent="searchVacation">
        <div class="">
            <p class="font-FlatBold text-xl sm:text-[22px] mt-8 lg:mt-0">
                الاجازات
            </p>
            <div class="grid grid-cols-1 gap-3 md:gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4 ">
                <div class=" h-12">
                    <select pla wire:model.defer="Name" name="name" wire:change='onChange("name")'
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
                        class="svgFoucusAdminVicationFrom absolute hidden inset-y-0 left-3 mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.defer="FromDate" id="hidePlaceHolderDateAdminVicationFrom" wire:change='onChange("FromDate")'
                        type="text" data-val-required="Mandatory field" data-val="true"
                        class="border-[#349A37] hidePlaceHolderDate  text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" من تاريخ" type="text" onblur="if(this.value==''){this.type='text'}"
                        onfocus="handelFocusVicationDateFrom()">
                        <div class="text-red-600 text-sm px-2 text-right">
                            {{ $this->exportWorkHoursErorrDate }}
                        </div>
                </div>
                <!--to Date  -->
                <div dir="ltr" class="relative h-12">
                    <div
                        class="svgFoucusVicationAdminTo absolute hidden inset-y-0 left-0 top-3 mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden=" true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.defer="ToDate" id="hidePlaceHolderDateVicationAdminTo" type="text" wire:change='onChange("ToDate")'
                        class="border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" الى تاريخ" onfocus="handelFocusVicationDateTo()">
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

                </div>
            </div>

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
                    @if ($vacations)
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
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37] min-w-[150px]">
                                        السبب
                                    </th>

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
                                @foreach ($vacations as $vacation)
                                    <tr>

                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">

                                            {{ $vacation->user->name }}
                                        </td>

                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                            {{ $vacation->day }}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                            {{ $vacation->date }}</td>

                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                            {{ $vacation->type }}</td>


                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">

                                            {{ $vacation->note }}


                                        </td>
                                        <td
                                            class=" flex whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                            <div class="flex flex-row items-center gap-x-2">
                                                <svg class="cursor-pointer"
                                                    wire:click="showEditModels({{ $vacation->id }})" width="35"
                                                    height="35" viewBox="0 0 56 55" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="56" height="55" rx="2" fill="#F7F7F7" />
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
                                                <svg class="cursor-pointer" wire:click="DeleteModel({{ $vacation->id }})"
                                                    width="35" height="35" viewBox="0 0 56 55" fill="none"
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
                                        {{ $this->vacations->count() }}

                                    </td>

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
                        <form class="Wraper2" wire:submit.prevent="EditVacation">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">تعديل الاجاز </p>
                            <!--First One -->

                            <div class="mt-2 selectdiv">
                                <input type="text" wire:model.defer="editDate"
                                    class="hidePlaceHolderEditDatePopUp border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                                    placeholder="تاريخ" onfocus="handelFocusEditDatePopup()">
                            </div>

                            <div class="mt-2 selectdiv">
                                <select wire:model.defer="editType"
                                    class="block  w-full  mt-4 border-[#349A37] border pr-4 rounded-[60px] sm:text-sm p-4 focus:ring-[#349A37] focus:border-[#349A37]">
                                    <option selected value="">الرجاء
                                        ادخال سبب المغادرة</option>

                                    @foreach ($Reasons_to_vacations as $Reasons)
                                        <option
                                            value={{ str_replace(' ', '_', $Reasons->attributes->Reasons_to_vacations) }}>
                                            {{ $Reasons->attributes->Reasons_to_vacations }}
                                        </option>
                                    @endforeach
                                    <option value="اخرى">
                                        اخرى
                                    </option>
                                </select>

                            </div>
                            <div class="mt-2 selectdiv">
                                <input type="text" wire:model.defer="editNote"
                                    class=" border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]">
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
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">اضافة اجازة </p>
                            <!--First One -->
                            <div class="mt-2 selectdiv ">
                                <select pla wire:model.defer="userId" name="userId"
                                    class="h-12 text-[#349A37] w-[100%] text-right border-[#349A37] border rounded-[60px] sm:text-base px-4 placeholder-[#349A37] ">
                                    <option class="text-black" value=null disabled> اسم الموظف </option>
                                    @foreach ($users as $user)
                                        <option class="text-[#349A37] " value="{{ $user['id'] }}">
                                            {{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                                <div class="text-red-600 text-sm px-2 text-right">
                                    {{ $this->exportWorkHoursErorrUserModel }}
                                </div>
                            </div>

                            <div class="mt-2 selectdiv">
                                <select wire:model.defer="type"
                                    class="h-12 text-[#349A37] w-[100%] text-right border-[#349A37] border rounded-[60px] sm:text-base px-4 placeholder-[#349A37]">
                                    <option selected value=null disabled>الرجاء
                                        ادخال سبب المغادرة</option>
                                    @foreach ($Reasons_to_vacations as $Reasons)
                                        <option class="text-[#349A37] "
                                            value={{ str_replace(' ', '_', $Reasons->attributes->Reasons_to_vacations) }}>
                                            {{ $Reasons->attributes->Reasons_to_vacations }}
                                        </option>
                                    @endforeach
                                    <option value="اخرى">
                                        اخرى
                                    </option>
                                </select>
                                <div class="text-red-600 text-sm px-2 text-right">
                                    {{ $this->exportWorkHoursErorrTypeModel }}
                                </div>
                            </div>
                            <div class="mt-2 selectdiv">
                                <input type="text" wire:model.defer="note" placeholder="ملاحظة"
                                    class=" border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-[100%] pl-10 p-2.5 placeholder-[#349A37]">
                            </div>
                            <div class="mt-2 selectdiv relative">
                                <div
                                    class="svgFoucusWorkHourVacations absolute hidden inset-y-0 left-4 top-3  mb-1 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden=" true" class="w-5 h-5 text-[#349A37] " fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" wire:model.defer ="date"
                                    id="hidePlaceHolderDatePopUp"
                                    class=" border-[#349A37] text-[#349A37] text-sm text-right
                                    rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-[97%] pl-10 p-2.5
                                    placeholder-[#349A37]"
                                    placeholder="تاريخ" onfocus="handelFocusDateVacationPopup()">
                                    <div class="text-red-600 text-sm px-2 text-right">
                                        {{ $this->exportWorkHoursErorrDateModel }}
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
    @if ($this->showDeleteModel == true)
    <div class="popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 top-[3%] z-10 flex items-center justify-center">
            <div class="relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:max-w-sm">
                <button class="absolute top-4 left-4 text-gray-600 hover:text-gray-800" wire:click="closeDeleteModel">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="px-6 py-4 text-right">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">تأكيد الحذف</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">هل أنت متأكد أنك تريد حذف هذا العنصر؟ لا يمكن التراجع عن هذا الإجراء.</p>
                    </div>
                    <div class="mt-4 flex justify-end gap-x-1">
                        <button class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="closeDeleteModel">
                            إلغاء
                        </button>
                        <button class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="Delete">
                            حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
    <!--end reason popup Timer -->


    <!--End Hourly work Time -->
</div>
