<div>
    <h1>Hello World!</h1>
    <div wire:poll.1000ms>
        {{ $this->realtimw }}
        {{ $this->WorkHoursLastMAnth }}
    </div>
    @if ($hide)
    <button wire:click="StartTimerWorkHours"
        class="ml-5 justify-center items-center md:w-[192px] h-[50px] px-4 py-2 border border-transparent text-base rounded-[12px] shadow-sm text-black hover:text-black duration-300 bg-[#32A6DF] hover:bg-[#FFBA1B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFBA1B] font-bold">
        Start  </button>
        @else
        <button wire:click="stop"
        class="ml-5 justify-center items-center md:w-[192px] h-[50px] px-4 py-2 border border-transparent text-base rounded-[12px] shadow-sm text-black hover:text-black duration-300 bg-[#32A6DF] hover:bg-[#FFBA1B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFBA1B] font-bold">
        stop  </button>
@endif

</div>
