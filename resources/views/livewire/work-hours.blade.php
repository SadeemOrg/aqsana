<div>
    {{-- <h1>Hello World!</h1> --}}

    {{-- <div wire:poll.1000ms>
        {{ $this->realTime }}
    </div> --}}
    {{-- @if ($hide)
    <button wire:click="StartTimerWorkHours"
        class="ml-5 justify-center items-center md:w-[192px] h-[50px] px-4 py-2 border border-transparent text-base rounded-[12px] shadow-sm text-black hover:text-black duration-300 bg-[#32A6DF] hover:bg-[#FFBA1B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFBA1B] font-bold">
        Start  </button>
        @else
        <button wire:click="stop"
        class="ml-5 justify-center items-center md:w-[192px] h-[50px] px-4 py-2 border border-transparent text-base rounded-[12px] shadow-sm text-black hover:text-black duration-300 bg-[#32A6DF] hover:bg-[#FFBA1B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFBA1B] font-bold">
        stop  </button>
@endif --}}


    <!--Perosonal Information -->
    <div class="flex sm:flex-row flex-col gap-y-4 sm:gap-y-0 items-center justify-between mt-8">
        <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">ساعات العمل</p>
        <div class="flex flex-row items-center  gap-x-2 ">
            <!--Date Picker -->
            <div dir="ltr" class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="#349A37"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input datepicker type="text"
                    class="bg-transparent border border-[#349A37] text-[#349A37] text-sm text-right rounded-[60px] block max-w-[150px] w-full  p-2.5 placeholder-[#349A37] "
                    placeholder="من">
            </div>
            <div dir="ltr" class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="#349A37"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input datepicker type="text"
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
        <div wire:click="stop" class="mt-8 flex flex-row items-center justify-center">
            <div wire:poll.1000ms class="w-60 h-60 rounded-[50%] bg-[#4F37FD] relative ">
                <p class="absolute bottom-24 left-[25%] text-white text-3xl"> {{ $this->realTime }}</p>
                <svg class="absolute bottom-5 left-[45%] " width="34" height="54" viewBox="0 0 34 54"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
    <!--End Timer -->
    <!--Start with Table -->
    @include('Components.User.UserTable', ['tab' => '2'])
    <!--End with Table -->




</div>
