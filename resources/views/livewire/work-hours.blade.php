<div>
    <!--Perosonal Information -->
    <form class="Wraper" wire:submit.prevent="searchWorkHours">
        <div
            class="">
            <p class="font-FlatBold w-full text-xl sm:text-[22px] text-center  lg:mt-0 xl:text-right">ساعات عملي</p>
            <div
                class=" grid grid-cols-1 gap-3 md:gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4">
                <!--Date Picker -->
                <div dir="ltr" class=" relative h-12">
                    <div
                        class="svgFoucusWorkHourFrom absolute inset-y-0 left-0 flex mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.debounce.50000ms="FromDate" id="hidePlaceHolderDateWorkHourFrom" type="text"
                        class="border-[#349A37] hidePlaceHolderDate  text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" من تاريخ" type="text" onfocus="handelFocusWorkHourFrom()">
                </div>
                <!--to Date  -->
                <div dir="ltr" class="relative">
                    <div
                        class="svgFoucusWorkHourTo absolute inset-y-0 left-0 flex mb-1 items-center pl-3 pointer-events-none">
                        <svg aria-hidden=" true" class="w-5 h-5 text-[#349A37] " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.debounce.50000ms="ToDate" id="hidePlaceHolderDateWorkHourTo" type="text"
                        class=" border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] focus:ring-[#349A37] focus:border-[#349A37] block w-full pl-10 p-2.5 placeholder-[#349A37]"
                        placeholder=" الى تاريخ" onfocus="handelFocusWorkerHourTo()">
                </div>

                <!--end Picker -->
                <div class=" h-12 flex gap-x-4">
                    <button type="button"
                        class="connectUs w-full duration-200 text-center px-1div0 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        بحث
                    </button>
                    <button wire:click="exportWorkHours" class="connectUs flex items-center justify-center w-full duration-200 text-center px-10 lg:px-10 py-3 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#40b744] hover:text-white ">
                        <svg class="min-w-[20px] min-h-[20px]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="20px" height="20px"><g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z"/></g></g></svg>
                        <span class="mr-2">تصدير CSV</span>
                    </button>
                </div>
                <span class="text-red-700">{{ $this->exportWorkHoursErorr }}</span>
                {{-- <div class=" h-12">

                </div> --}}

            </div>

        </div>
    </form>

    <!--End Perosonal Information -->
    <!--Start Timer -->
    {{-- @if ($hide)
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
    @endif --}}


    <div
        class="timer flex flex-row items-start justify-center sm:justify-start gap-x-4 my-10 flex-wrap gap-y-4 md:gap-y-0 md:flex-nowrap">
        <div
            class="sm:max-w-[65%] md:max-w-[200px] w-full flex items-center justify-center h-16 rounded-[4px] md:h-16 bg-[#349A37]">
            <p id="timer" class="text-white text-2xl"></p>
        </div>
        <div class="cursor-pointer min-w-[100px]  mb-4">
            <svg wire:click="EndWork" class="h-16 md:h-16 " width="100"  viewBox="0 0 163 114"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="163" height="114" rx="6" fill="#349A37" />
                <g clip-path="url(#clip0_59_1521)">
                    <path
                        d="M98.4 34H61.6C59.0654 34 57 36.0654 57 38.6V75.4C57 77.9346 59.0654 80 61.6 80H98.4C100.935 80 103 77.9346 103 75.4V38.6C103 36.0654 100.935 34 98.4 34Z"
                        fill="white" />
                </g>
                <defs>
                    <clipPath id="clip0_59_1521">
                        <rect width="46" height="46" fill="white" transform="translate(57 34)" />
                    </clipPath>
                </defs>
            </svg>
        </div>
        @if ($hide)
            <div id="start_timer" onclick="start()" wire:click="StartTimerWorkHours"
                class="cursor-pointer min-w-[100px]  mb-4">

                <svg class="h-16 md:h-16 " width="100" viewBox="0 0 163 114" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="163" height="114" rx="6" fill="#349A37" />
                    <path d="M64 80V34L102.927 57.0011L64 80Z" fill="white" />
                </svg>
            </div>
        @else
            <div id="stop_timer" wire:click="stop" class="cursor-pointer min-w-[100px]  mb-4">
                <svg class="h-16 md:h-16 " width="100" viewBox="0 0 163 114" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="163" height="114" rx="6" fill="#349A37" />
                    <path
                        d="M72.0027 34C69.2392 34 67 36.2402 67 39.0027V74.9973C67 77.7618 69.2392 80 72.0027 80C74.7662 80 77.0054 77.7608 77.0054 74.9973V39.0027C77.0054 36.2392 74.7672 34 72.0027 34Z"
                        fill="white" />
                    <path
                        d="M90.0125 34C87.249 34 85.0098 36.2402 85.0098 39.0027V74.9973C85.0098 77.7608 87.249 80 90.0125 80C92.776 80 95.0152 77.7608 95.0152 74.9973V39.0027C95.0152 36.2402 92.776 34 90.0125 34Z"
                        fill="white" />
                </svg>

            </div>
        @endif

    </div>

    <!--start reason popup Timer -->
    @if ($this->showModel == true)
        <div class=" popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-auto">
                <div class="flex flex-col min-h-full justify-center p-4 text-center items-center sm:p-0">

                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-xl sm:p-6">
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


                                @if ($showTable2 == 'اخرى' && $this->showModel == true)
                                    <div class="ml-1  pt-6 lg:px-0 ">
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
        <div class="mt-8 flow-root">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <table class="min-w-full divide-y divide-gray-300 border-2">
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
                            <tr>
                                <td colspan="2" class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] border-2 border-[#349A37] bg-white">
                                    <span>مجموع الايام: </span>
                                    <span>{{ $WorkHourssearch->count() }}</span>
                                </td>
                                <td colspan="3" class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] border-2 border-[#349A37] bg-white">
                                    <span> مجموع الساعات: </span>
                                    @if ($WorkHourssearch->count() == 0)
                                        <span>00:00:00</span>
                                    @else
                                        <span>
                                            {{ $sumWorkHourssearch->day * 24 + $sumWorkHourssearch->hour }}:{{ $sumWorkHourssearch->minute }}:{{ $sumWorkHourssearch->second }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
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
<script>
    var sites = {!! json_encode($this->realTime) !!};
    var hide = {!! json_encode($this->hide) !!};
    // alert(sites)
    let regExTime = /([0-9]?[0-9]):([0-9][0-9]):([0-9][0-9])/;
    let regExTimeArr = regExTime.exec(
        sites); // ["01:12:33", "01", "12", "33", index: 0, input: "01:12:33", groups: undefined]
    let timeHr = regExTimeArr[1] * 3600;
    let timeMin = regExTimeArr[2] * 60;
    let timeSec = regExTimeArr[3] * 1;
    let times = timeHr + timeMin + timeSec;
    console.log("dddddddddddddddd");
    console.log("timeHr", regExTimeArr[1], timeHr);
    console.log("timeMin", regExTimeArr[2], timeMin);
    console.log("timeSec", regExTimeArr[3], timeSec);
    console.log("times", times);
    // alert(regExTimeArr[1] )
    // var target = new Date("1970-01-01T" + sites);
    // alert(target)

    var totalSeconds = times;
    var timerVar;
    if (hide == 0) {

        start();
    } else {

        document.getElementById("timer").innerHTML = regExTimeArr[1] + ":" + regExTimeArr[2] + ":" + regExTimeArr[3];



    }

    function start() {

        timerVar = setInterval(countTimer, 1000);


    }

    function myStopFunction() {

        clearInterval(timerVar);
        document.getElementById("stop_timer").style.display = "none";
        document.getElementById("start_timer").style.display = "block";


    }

    function countTimer() {

        ++totalSeconds;
        var hour = Math.floor(totalSeconds / 3600);
        var minute = Math.floor((totalSeconds - hour * 3600) / 60);
        var seconds = totalSeconds - (hour * 3600 + minute * 60);
        if (hour < 10)
            hour = "0" + hour;
        if (minute < 10)
            minute = "0" + minute;
        if (seconds < 10)
            seconds = "0" + seconds;
        document.getElementById("timer").innerHTML = hour + ":" + minute + ":" + seconds;

    }
</script>
