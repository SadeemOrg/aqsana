<div>
    @php
        // use Carbon\Carbon;
        // dd($sumWorkHourssearch);

        // $sumWorkHourssearch = '113128';
        // $date = Carbon::parse($string);
        // dd($date);
        // $starttime = Carbon::parse($sumWorkHourssearch);

        // $sumWorkHours = Carbon::createFromFormat('Y-m-d H:i:s', $starttime);
        // $newTimeShape = date_format($sumWorkHours, 'H:i:s');

        // dd($sumWorkHourssearch , $startDate);
        // dd(gettype($sumWorkHourssearch));
    @endphp
    <!--Perosonal Information -->
    <form wire:submit.prevent="sershWorkHours">
        <div class="flex sm:flex-row flex-col gap-y-4 sm:gap-y-0 items-center justify-between mt-8">
            <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">ساعات عمل
                الموظفين</p>
            <div class="flex flex-row items-center  gap-x-2 ">
                <div class="mt-1">
                    اسم الموظف
                    <select pla wire:model="Name" name="name"
                        class="block md:min-w-[235px] w-full  border-[#349A37] border rounded-[60px] sm:text-sm p-4 placeholder-[#349A37] text-left">
                        <option value="0"> اسم الموظف </option>


                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>
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
                        placeholder="الى">
                </div>
                <!--end Picker -->
                <div class="-mt-2">
                    <button type="submit"
                        class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                        بحث
                    </button>

                </div>
            </div>
        </div>
    </form>
    <button  wire:click="showAddModels"  class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">اضافة</button>

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
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    @if ($WorkHourssearch)
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
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
                            <tbody class="divide-y divide-gray-200">
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

                                            <?xml version="1.0" encoding="iso-8859-1"?>
                                            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                            <!DOCTYPE svg
                                                PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                            <svg wire:click="showNoteModels({{ $WorkHoursearch->id }})" fill="#000000"
                                                version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="82" height="24"
                                                viewBox="0 0 442.04 442.04" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M221.02,341.304c-49.708,0-103.206-19.44-154.71-56.22C27.808,257.59,4.044,230.351,3.051,229.203
                                                        c-4.068-4.697-4.068-11.669,0-16.367c0.993-1.146,24.756-28.387,63.259-55.881c51.505-36.777,105.003-56.219,154.71-56.219
                                                        c49.708,0,103.207,19.441,154.71,56.219c38.502,27.494,62.266,54.734,63.259,55.881c4.068,4.697,4.068,11.669,0,16.367
                                                        c-0.993,1.146-24.756,28.387-63.259,55.881C324.227,321.863,270.729,341.304,221.02,341.304z M29.638,221.021
                                                        c9.61,9.799,27.747,27.03,51.694,44.071c32.83,23.361,83.714,51.212,139.688,51.212s106.859-27.851,139.688-51.212
                                                        c23.944-17.038,42.082-34.271,51.694-44.071c-9.609-9.799-27.747-27.03-51.694-44.071
                                                        c-32.829-23.362-83.714-51.212-139.688-51.212s-106.858,27.85-139.688,51.212C57.388,193.988,39.25,211.219,29.638,221.021z" />
                                                    </g>
                                                    <g>
                                                        <path
                                                            d="M221.02,298.521c-42.734,0-77.5-34.767-77.5-77.5c0-42.733,34.766-77.5,77.5-77.5c18.794,0,36.924,6.814,51.048,19.188
                                                        c5.193,4.549,5.715,12.446,1.166,17.639c-4.549,5.193-12.447,5.714-17.639,1.166c-9.564-8.379-21.844-12.993-34.576-12.993
                                                        c-28.949,0-52.5,23.552-52.5,52.5s23.551,52.5,52.5,52.5c28.95,0,52.5-23.552,52.5-52.5c0-6.903,5.597-12.5,12.5-12.5
                                                        s12.5,5.597,12.5,12.5C298.521,263.754,263.754,298.521,221.02,298.521z" />
                                                    </g>
                                                    <g>
                                                        <path
                                                            d="M221.02,246.021c-13.785,0-25-11.215-25-25s11.215-25,25-25c13.786,0,25,11.215,25,25S234.806,246.021,221.02,246.021z" />
                                                    </g>
                                                </g>
                                            </svg>

                                        </td>
                                        <td
                                            class=" flex whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                            <svg wire:click="showEditModels({{ $WorkHoursearch->id }})" width="25"
                                                height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.5266 0.0390625L2.0202 16.5467C1.93715 16.63 1.87719 16.7351 1.84864 16.8482L0.019057 24.1917C-0.035671 24.4128 0.0292887 24.6478 0.190617 24.8092C0.312684 24.9312 0.47901 24.9988 0.649142 24.9988C0.701253 24.9988 0.754553 24.9924 0.806426 24.9793L8.14997 23.1495C8.26442 23.1209 8.3684 23.0612 8.45144 22.9782L24.9593 6.47174L18.5266 0.0390625Z"
                                                    fill="#349A37" />
                                            </svg>
                                            <svg wire:click="Delete({{ $WorkHoursearch->id }})" width="24"
                                                height="22" viewBox="0 0 24 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.64502 0.789062L2.2018 19.5821C2.31336 20.9374 3.46777 22 4.8282 22H19.1722C20.5327 22 21.6871 20.9374 21.7986 19.5821L23.3554 0.789062H0.64502ZM7.60484 18.4844C7.14476 18.4844 6.75769 18.1265 6.72851 17.6604L5.84961 3.48068C5.81955 2.99576 6.18775 2.57863 6.67185 2.54857C7.17394 2.51336 7.57308 2.8859 7.60396 3.37082L8.48287 17.5505C8.51398 18.0527 8.11666 18.4844 7.60484 18.4844ZM12.8791 17.6055C12.8791 18.0913 12.486 18.4844 12.0002 18.4844C11.5144 18.4844 11.1213 18.0913 11.1213 17.6055V3.42578C11.1213 2.93998 11.5144 2.54688 12.0002 2.54688C12.486 2.54688 12.8791 2.93998 12.8791 3.42578V17.6055ZM18.1508 3.48074L17.2719 17.6604C17.243 18.1218 16.8584 18.5063 16.3398 18.4827C15.8557 18.4526 15.4875 18.0355 15.5175 17.5506L16.3964 3.37088C16.4265 2.88596 16.8513 2.53316 17.3285 2.54863C17.8126 2.57869 18.1808 2.99582 18.1508 3.48074Z"
                                                    fill="#E92F30" />
                                            </svg>


                                        </td>
                                    </tr>
                                @endforeach

                                <tr>

                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                        مجموع الساعات

                                    </td>

                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]"> </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]"></td>

                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">
                                        {{ $sumWorkHourssearch }}
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
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-auto">
                <div class="flex flex-col min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                        <button>
                            <svg wire:click="closeEditModel" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>


                        <form wire:submit.prevent="EditDay">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">تعديل اليوم </p>
                            <!--First One -->
                            <div class="mt-2 selectdiv">
                                @php
                                    //    dd( $EditWorkHours->date->format('m:d:y') );
                                @endphp
                                <input wire:model="date" type="text"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                                    value="{{ date_format($EditWorkHours->date, 'd/m/Y') }}">

                            </div>
                            <div class="mt-2 selectdiv">

                                <input type="text" wire:model="start_time"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                                    value="{{ $EditWorkHours->start_time }}">

                            </div>
                            <div class="mt-2 selectdiv">

                                <input type="text" wire:model="end_time"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                                    value="{{ $EditWorkHours->end_time }}">

                            </div>
                            <div class="mt-2 selectdiv">

                                <input type="text" wire:model="day_hours"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                                    value="{{ $EditWorkHours->day_hours }}">

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
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-auto">
                <div class="flex flex-col min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                        <button>
                            <svg wire:click="closeAddModel" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>


                        <form wire:submit.prevent="AddDay">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">تعديل اليوم </p>
                            <!--First One -->
                            <div class="mt-2 selectdiv">
                                اسم الموظف
                                <select pla wire:model="ModelId" name="ModelId"
                                    class="block md:min-w-[235px] w-full  border-[#349A37] border rounded-[60px] sm:text-sm p-4 placeholder-[#349A37] text-left">
                                    <option value="0"> اسم الموظف </option>


                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2 selectdiv">
                                @php
                                    //    dd( $EditWorkHours->date->format('m:d:y') );
                                @endphp
                                <input wire:model="date" type="text"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                            </div>
                            <div class="mt-2 selectdiv">

                                <input type="text" wire:model="start_time"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                            </div>
                            <div class="mt-2 selectdiv">

                                <input type="text" wire:model="end_time"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                            </div>
                            <div class="mt-2 selectdiv">

                                <input type="text" wire:model="day_hours"
                                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

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
    @if ($this->showNoteModels == true)
        <div class=" popUpTimerReason relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 top-[3%] z-10 overflow-y-auto">
                <div class="flex flex-col min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div
                        class=" relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                        <button>
                            <svg wire:click="closeNoteModels" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>


                        <form wire:submit.prevent="EditNote">
                            <p class="w-full text-center mt-2 text-[20px] text-[#151630]">تعديل اليوم </p>
                            <!--First One -->
                            {{-- {{$Notes  }} --}}
                            @if ($Notes)
                                @foreach ($Notes as $key => $Note)
                                    <div class="mt-2 selectdiv">

                                        <input wire:model="notedate.{{ $key }}.Type" type="text"
                                            class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                                    </div>
                                    <div class="mt-2 selectdiv">

                                        <input type="text" wire:model="notedate.{{ $key }}.required_time"
                                            class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                                    </div>
                                    <div class="mt-2 selectdiv">

                                        <input type="text" wire:model="notedate.{{ $key }}.time_out"
                                            class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                                    </div>
                                    <div class="mt-2 selectdiv">

                                        <input type="text" wire:model="notedate.{{ $key }}.return_time"
                                            class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] ">

                                    </div>






                                    <div class="mt-2">
                                        <button type="submit"
                                            class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                            تطبيق
                                        </button>
                                        <button type="submit"
                                            class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                                            تطبيق
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <p>no data</p>
                            @endif

                        </form>



                        <!--Endsecond Page -->
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--end reason popup Timer -->

    {{-- @include('Components.User.UserTable', ['tab' => '3']) --}}
    <!--End with Table -->

    <!--End Hourly work Time -->
</div>
