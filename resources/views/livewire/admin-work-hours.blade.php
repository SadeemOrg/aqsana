<div>

        <!--Perosonal Information -->
        <form wire:submit.prevent="sershWorkHours">
        <div class="flex sm:flex-row flex-col gap-y-4 sm:gap-y-0 items-center justify-between mt-8">
            <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">ساعات عمل
                الموظفين</p>
            <div class="flex flex-row items-center  gap-x-2 ">
                <div class="mt-1">

                    <select pla  wire:model="Name" name="name"
                    class="block md:min-w-[235px] w-full  border-[#349A37] border rounded-[60px] sm:text-sm p-4 placeholder-[#349A37] text-left">
                    <option value="0"> اسم الموظف </option>


                    @foreach($users as $user)
                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
              </div>
                <!--Date Picker -->
                <div dir="ltr" class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">

                    </div>
                    <input  type="date" wire:model="FromDate"
                        class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                        placeholder="من">

                </div>
                <div dir="ltr" class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">

                    </div>
                    <input  type="date" wire:model="ToDate"
                        class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                        placeholder="الى">
                </div>
                <!--end Picker -->
                <div class="-mt-2">
                    <button type="submit"
                        class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                        تطبيق
                    </button>
                </div>
            </div>
        </div>
        </form>
        <!--End Perosonal Information -->
        <!--from Date -->
        @if ($this->FromDate &&  $this->ToDate)
        <div class="mt-8 flex flex-row items-center justify-start gap-x-3">
            <p class="text-[#8A8B9F] text-sm ">من تاريخ : {{ $this->FromDate }}</p>
            <p class="text-[#8A8B9F] text-sm ">الى تاريخ :{{  $this->ToDate }}</p>

        </div>
        @endif

        <!--End Date -->
        <!--Start with Table -->
        <div class="px-4 sm:px-6 lg:px-8 mt-8">
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        @if($WorkHourssearch)
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>

                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-right text-sm font-semibold text-[#349A37] ">
                                            اسم الموظف</th>

                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-right text-sm font-semibold text-[#349A37] ">
                                        اليوم</th>
                                    <th scope="col" class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">
                                        التاريخ
                                    </th>
                                    <th scope="col" class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">ساعة
                                        البدء
                                    </th>
                                    <th scope="col" class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">ساعة
                                        الانتهاء</th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37] min-w-[150px]">عدد
                                        ساعات العمل</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($WorkHourssearch as $WorkHoursearch)
                                    <tr>

                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                            {{-- {{ $dataaaa[0]['start_time'] }} --}}
                                            {{ $WorkHoursearch->user_id}}                                            </td>

                                            <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                            {{ $WorkHoursearch->day}}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">  {{ $WorkHoursearch->date}}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                            {{ $WorkHoursearch->start_time}}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">{{ $WorkHoursearch->end_time}}</td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">{{ $WorkHoursearch->day_hours}}
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('Components.User.UserTable', ['tab' => '3']) --}}
        <!--End with Table -->

        <!--End Hourly work Time -->
</div>
