<div class="firstPage mt-14 w-full flex flex-col md:flex-row items-center justify-between gap-x-10 gap-y-8 md:gap-y-0">
    <div
        class="text-center w-[65%] md:w-full flex flex-col justify-start items-start border-t-[6px] border-[#349A37]">
        <p class="mt-8 text-[#6B7280] text-xs">الخطوة الاولى</p>
        <h6 class="text-sm font-FlatBold pt-2">البيانات الشخصية</h6>
    </div>
    <div
        class="text-center w-[65%] md:w-full flex flex-col justify-start items-start border-t-[6px] border-[#E5E7EB]">
        <p class="mt-8 text-[#6B7280] text-xs">الخطوة الثانية</p>
        <h6 class="text-sm font-FlatBold pt-2">بيانات الدفع</h6>
    </div>
</div>
<!-- Second Page -->
<div class="secondPage hidden">
<div class="mt-14 w-full flex flex-col md:flex-row items-center justify-between gap-x-10 gap-y-8 md:gap-y-0">
    <div class="text-center w-[65%] md:w-full flex flex-col justify-start items-start border-t-[6px] border-[#E5E7EB]">
        <p class="mt-8 text-[#6B7280] text-xs">الخطوة الاولى</p>
        <h6 class="text-sm font-FlatBold pt-2">البيانات الشخصية</h6>
    </div>
    <div
        class="text-center w-[65%] md:w-full flex flex-col justify-start items-start border-t-[6px] border-[#349A37]">
        <p class="mt-8 text-[#6B7280] text-xs">الخطوة الثانية</p>
        <h6 class="text-sm font-FlatBold pt-2">بيانات الدفع</h6>
    </div>
</div>
</div>
<h1 class="firstPage mt-16 text-2xl text-center md:text-right">البيانات الشخصية</h1>
<h1 class="secondPage hidden mt-16 text-2xl text-center md:text-right">بيانات الدفع</h1>

<div class="hidden secondPage">
<div class="sm:flex sm:flex-row items-center mt-4 ">
    <div class="flex flex-row pr-6 items-center mb-5 sm:mb-0">
        <input id="visa" name="notification-method" type="radio" value="visa"
            class="focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
        <label for="visa" class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">
            <span>فيزا كارد</span>
            <img src="{{asset('assets/image/visa_1.svg')}}" class="pl-3 w-[52px]" />
        </label>
    </div>
    <div class="flex flex-row pr-6 items-center">
        <input id="recived" name="notification-method" checked type="radio" value="recived"
            class="focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative">
        <label for="recived" class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">
            <span>الدفع عند الأستلام </span>
            <img src="{{asset('assets/image/home_1.svg')}}" class="pl-3">
        </label>
    </div>
</div>

</div>
<div class="firstPage mt-10 sm:mt-10 flex flex-col gap-y-6">
    <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
        <input type="text" name="" placeholder=" الاسم الاول"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
        <input type="text" name="" placeholder=" الاسم الاخير"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
    </div>
    <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
        <input type="text" name="" placeholder="رقم الهاتف"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
    </div>
    <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
        <button id="firstPageDonations"
            class="rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">متابعة</button>
    </div>
</div>
<!-- Second Page -->
<div class="secondPage hidden mt-10 sm:mt-10 flex flex-col gap-y-6">
    <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
        <input type="text" name="" placeholder="الاسم على البطاقة"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
        <input type="text" name="" placeholder="رقم البطاقة"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
    </div>
    <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
        <input type="text" name="" placeholder="MM/YY"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <input type="text" name="" placeholder="CVV"
            class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
    </div>

    <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
        <button
            class="rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">تبرع الأن</button>
            <button id="goBack"
            class="rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200"> الخلف</button>
        </div>
</div>
