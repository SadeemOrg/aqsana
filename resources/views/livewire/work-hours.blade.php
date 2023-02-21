<div>


    <!--Perosonal Information -->
    <div class="flex sm:flex-row flex-col gap-y-4 sm:gap-y-0 items-center justify-between mt-8">
        <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">ساعات عملي</p>
        <form wire:submit.prevent="sershWorkHours">
            <div class="flex flex-row items-center  gap-x-2 ">
                <!--Date Picker -->


                <div dir="ltr" class="relative text-right">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    </div>
                    من
                    <input type="date" wire:model="FromDate"
                        class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                        placeholder="من">
                </div>
                <div dir="ltr" class="relative text-right">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    </div>
                    الى

                    <input type="date" wire:model="ToDate"
                        class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                        placeholder="من">
                </div>



                <!--end Picker -->
                <div class="-mt-2">
                    <button type="submit"
                        class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                        بحث
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!--End Perosonal Information -->
    <!--Start Timer -->
    @if ($hide)
        <div wire:click="StartTimerWorkHours" class="mt-8 flex flex-row items-center justify-center">
            <div wire:poll.1000ms class="w-60 h-60 rounded-[50%] bg-[#4F37FD] relative ">
                @if ($this->realTime)
                    <p class="absolute bottom-24 left-[25%] text-white text-3xl"> {{ $this->realTime }}</p>
                @else
                    <p class="absolute bottom-24 left-[25%] text-white text-3xl"> 00:00:00</p>
                @endif
                <svg class="absolute bottom-5 left-[45%] " width="46" height="54" viewBox="0 0 46 54"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.151367 54V0L45.8482 27.0013L0.151367 54Z" fill="white" />
                </svg>
            </div>
        </div>
    @else
        <div class=" mt-8 flex flex-row items-center justify-center">
            <div wire:poll.1000ms class="w-60 h-60 rounded-[50%] bg-[#4F37FD] relative ">
                <p class="absolute bottom-24 left-[25%] text-white text-3xl"> {{ $this->realTime }} </p>
                <svg wire:click="stop" class=" absolute bottom-5 left-[45%] " width="34" height="54"
                    viewBox="0 0 34 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.42842 0C3.18431 0 0.555664 2.62982 0.555664 5.87276V48.1272C0.555664 51.3725 3.18431 54 6.42842 54C9.67253 54 12.3012 51.3714 12.3012 48.1272V5.87276C12.3012 2.62865 9.67371 0 6.42842 0Z"
                        fill="white" />
                    <path
                        d="M27.57 0C24.3259 0 21.6973 2.62982 21.6973 5.87276V48.1272C21.6973 51.3714 24.3259 54 27.57 54C30.8141 54 33.4428 51.3714 33.4428 48.1272V5.87276C33.4428 2.62982 30.8141 0 27.57 0Z"
                        fill="white" />
                </svg>
            </div>
        </div>
    @endif

    <!--start reason popup Timer -->
    @if ($this->showModel == true)
        <div class=" popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-auto">
                <div class="flex flex-col min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                        <button>
                            <svg wire:click="closeModel" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        @if ($form == 0)
                            <form wire:submit.prevent="ModelForm">
                                <p class="w-full text-center mt-2 text-[20px] text-[#151630]">سبب المغادرة</p>
                                <!--First One -->
                                <div class="mt-2 selectdiv">



                                </div>

                                <div class="mt-2 selectdiv">
                                    <select wire:model="Timeleave"
                                        class="block  w-full  mt-4 border-[#349A37] border pr-4 rounded-[60px] sm:text-sm p-4 focus:ring-[#349A37] focus:border-[#349A37]">
                                        <option selected value="">الوقت</option>
                                        @foreach ($TimeDpartures as $TimeDparture)
                                            <option value={{ $TimeDparture->attributes->time_departure }}>
                                                {{ $TimeDparture->attributes->title_departure }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mt-2 selectdiv">
                                    <select wire:model="leaveGoal" wire:click="changeEvent2($event.target.value)"
                                        class="block  w-full  mt-4 border-[#349A37] border pr-4 rounded-[60px] sm:text-sm p-4 focus:ring-[#349A37] focus:border-[#349A37]">
                                        <option selected value="">الرجاء
                                            ادخال سبب المغادرة</option>
                                        @foreach ($Reasons_to_stop as $Reasons)
                                            <option value={{ $Reasons->attributes->Reasons_to_stop }}>
                                                {{ $Reasons->attributes->Reasons_to_stop }}
                                            </option>
                                        @endforeach
                                        <option value="اخرى">
                                            اخرى
                                        </option>
                                    </select>
                                </div>


                                @if ($showTable2 == 'اخرى' && $showTable == 2)
                                    <div class="ml-1  pt-6 px-8 lg:px-0 ">
                                        <textarea wire:model="leaveGoalTextarea" rows="4" name="message" placeholder="سبب المغادرة"
                                            class="w-full  inline-flex items-center text-right  justify-center border-[#349A37] border  rounded-[10px] focus:ring-[#349A37] focus:border-[#349A37] sm:text-sm p-4"></textarea>
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <button type="submit"
                                        class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                        تطبيق
                                    </button>
                                </div>
                            </form>
                        @endif


                        <!--Endsecond Page -->
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--end reason popup Timer -->


    <!--End Timer -->
    <!--Start with Table -->




    <div class="px-4 sm:px-6 lg:px-8 mt-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
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
                                    ساعات العمل</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php
                                use Carbon\Carbon;

                            @endphp
                            @foreach ($WorkHourssearch as $WorkHoursearch)
                                @php
                                    $newTimeShape = date_format($WorkHoursearch->date, 'd/m/Y');

                                @endphp
                                <tr>

                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                        {{ $WorkHoursearch->day }}</td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]"> {{ $newTimeShape }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">

                                        {{ $WorkHoursearch->start_time }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                        {{ $WorkHoursearch->end_time }}</td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                        {{ $WorkHoursearch->day_hours }}
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>






    {{-- @include('Components.User.UserTable', ['tab' => '2','dataaaa'=> $WorkHoursearchs]) --}}

    {{-- @include('Components.User.UserTable', ['items' => $item['children']])
    @include('Components.User.UserTable', ['ee'=>$WorkHoursearchs]) --}}
    <!--End with Table -->




</div>
