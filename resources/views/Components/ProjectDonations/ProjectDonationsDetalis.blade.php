<style>
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
@php
$project_Id = 1;
@endphp
<form class="flex flex-col w-full items-center md:items-start justify-center">
    <div class="flex flex-row items-center ">
        <div class="mt-10 firstPage">
            <label for="price" class="block text-sm font-medium text-gray-700 pr-1">المبلغ المراد التبرع به</label>
            <div class="mt-2 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm"> ₪ </span>
                </div>
                <input type="number" name="price" id="price"
                    class="focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"
                    placeholder="0.00" aria-describedby="price-currency">
            </div>
        </div>
    </div>
    <!-- Sector -->
    @if($project_Id !== null)
    <div class="mt-4 firstPage">
        <label for="sector" class=" pr-1 block text-sm font-medium text-gray-700">القطاعات</label>
        <div class="mt-2">
            <input type="text" name="sector" id="sector" value="قطاع الزراعه" disabled
                class="shadow-sm block sm:text-sm border-gray-300 rounded-md">
        </div>
    </div>
    <!-- title -->
    <div class="mt-4 firstPage">
        <label for="title" class=" pr-1 block text-sm font-medium text-gray-700">عنوان المشروع</label>
        <p
            class="shadow-sm block sm:text-sm border px-4 md:px-2 p-2 mt-2 border-gray-300 rounded-md max-w-[220px] sm:max-w-[210px] md:max-w-none">
            اكثر من 10 الاف مشارك بمعسكر 'القدس اولا' الذي نظمته الحركة الاسلامية وجمعية الاقصى
        </p>
    </div>
    @else
    <div class="firstPage pt-6  lg:px-0 w-[25opx] lg:w-[80%]">
        <label for="donationAim" class=" pr-1 block text-sm font-medium text-gray-700">سبب التبرع</label>
        <textarea rows="4" name="donationAim" id="order_note" placeholder="سبب التبرع" required=""
            class="w-full mt-2 inline-flex items-center text-right  justify-center  border rounded-md focus:ring-green-500 focus:border-green-500  border-gray-300 sm:text-sm p-4"></textarea>
    </div>
    @endif
    <!-- Second Page Input -->
    <div class="secondPage mt-10 sm:mt-20 flex flex-col gap-y-6 hidden w-full">
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <input type="text" name="" placeholder=" الاسم الاول"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <input type="text" name="" placeholder=" الاسم الاخير"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
        </div>
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <input type="text" name="" placeholder="رقم الهاتف"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <input type="text" name="" placeholder="رقم البطاقة"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
        </div>
        <div class="flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start w-full gap-x-5">
            <input type="text" name="" placeholder="CVV"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            <div dir="ltr" class="w-[80%] md:w-[50%]">
                <input datepicker type="text"
                    class="block w-full border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 text-right"
                    placeholder="MM/YY">
            </div>
        </div>
        <!-- Second Page Radio Input -->
        <div class="sm:flex sm:flex-row items-center mt-4 mr-[9%] md:mr-0">
            <div class="flex flex-row items-center mb-5 sm:mb-0">
                <input id="visa" name="notification-method" type="radio" value="visa"
                    class="focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
                <label for="visa"
                    class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">
                    <span>فيزا كارد</span>
                    <img src="{{asset('assets/image/visa_1.svg')}}" class="pl-3 w-[52px]" />
                </label>
            </div>
            <div class="flex flex-row md:pr-6 items-center">
                <input id="recived" name="notification-method" checked type="radio" value="recived"
                    class="focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative">
                <label for="recived"
                    class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">
                    <span>الدفع عند الأستلام </span>
                    <img src="{{asset('assets/image/home_1.svg')}}" class="pl-3">
                </label>
            </div>
        </div>
    </div>
</form>

<!-- third Page Input -->
<div class="thirdPage mt-24 flex flex-col items-center justify-center hidden">
    @php
    $img = 'storage/'. nova_get_setting('logo', 'default_value');
    @endphp
    <img class="w-[370px] h-24" src="/{{ $img }}" alt="logo">
    <p class="text-[30px] max-w-md mt-8 text-center">
        تم التبرع بنجاح لصالح مشروع اسم المشروع بمبلغ قدره
        <span class="text-[#349A37]">500 شيكل </span>
    </p>
    <a target="_self"
        class="bg-[#349A37] mt-5 hover:bg-[#101426] duration-200 py-3 px-4 ml-2 text-white  rounded-[50px] text-lg  "
        href="/">الصفحة الرئيسية</a>

</div>

<div class="flex flex-row items-center justify-center md:justify-start gap-x-2">
    <div class="mt-10 flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start  gap-x-5">
        <button id="firstPageDonations"
            class="Ctnbtn rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">متابعة</button>
    </div>
    <div
        class="secondPage mt-10 flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start  gap-x-5 hidden">
        <button id="PreviousPageDonations"
            class="rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">الخلف</button>
    </div>
</div>
