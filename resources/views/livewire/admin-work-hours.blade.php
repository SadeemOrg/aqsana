<div>
        <!--Perosonal Information -->
        <form wire:submit.prevent="sershWorkHours">
        <div class="flex sm:flex-row flex-col gap-y-4 sm:gap-y-0 items-center justify-between mt-8">
            <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">ساعات عمل
                الموظفين</p>
            <div class="flex flex-row items-center  gap-x-2 ">
                <div class="mt-1">
                    <input type="text" wire:model="Name" name="name" placeholder=" اسم الموظف" value=""
                        class="block md:min-w-[235px] w-full max-h-[42px] border-[#349A37] border rounded-[60px] sm:text-sm p-4 placeholder-[#349A37]">
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
        <div class="mt-8 flex flex-row items-center justify-start gap-x-3">
            <p class="text-[#8A8B9F] text-sm ">من تاريخ : 12-5-2022</p>
            <p class="text-[#8A8B9F] text-sm ">الى تاريخ : 12-5-2022</p>

        </div>
        <!--End Date -->
        <!--Start with Table -->
        @include('Components.User.UserTable', ['tab' => '3'])
        <!--End with Table -->

        <!--End Hourly work Time -->
</div>
