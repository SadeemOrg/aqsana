<style>
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
@if ($project == null)
    @php
        $project_Id = null;
    @endphp
@else
    @php
        $project_Id = $project->id;
    @endphp
@endif

<div>
    <form class="flex flex-col w-full items-center md:items-start justify-center" action="{{ route('donations') }}"
        method="post">
        @csrf
        <div class="flex flex-row items-center ">
            <div class="mt-10 firstPage">
                <label for="price" class="block text-sm font-medium text-gray-700 pr-1">المبلغ المراد التبرع به</label>
                <div class="mt-2 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm"> ₪ </span>
                    </div>
                    <input type="number" name="donation_amount" id="price"
                        class="focus:ring-green-500 focus:border-green-500 block  sm:text-sm border-gray-300 rounded-md w-[220px] md:w-[210px]"
                        placeholder="0.00" aria-describedby="price-currency">
                </div>
            </div>
        </div>
        <!-- Sector -->
        {{-- @php
            dd($project);
        @endphp --}}
        @if ($project_Id !== null)
            <div class="mt-4 firstPage">
                <label for="sector" class=" pr-1 block text-sm font-medium text-gray-700">القطاعات</label>
                <div class="mt-2">
                    <input type="text" name="sector" id="sector" value="{{ $project->sector }}" disabled
                        class="shadow-sm block sm:text-sm border-gray-300 rounded-md w-[220px] md:w-[210px]">
                </div>
            </div>
            <!-- title -->
            <div class="mt-4 firstPage ">
                <label for="title" class="block  text-sm font-medium text-gray-700">عنوان المشروع</label>
                <p
                    class="shadow-sm hidden md:block sm:text-sm border px-4 md:px-2 p-2 mt-2 min-w-[210px] border-gray-300 rounded-md   ">

                    {{ Illuminate\Support\Str::limit($project->project_name, 113) }}
                </p>
                <p
                    class="shadow-sm block md:hidden  text-sm border px-4 md:px-2 p-2 mt-2 border-gray-300 rounded-md w-[220px]">
                    {{ Illuminate\Support\Str::limit($project->project_name, 70) }}

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
                <input type="text" id="firstName" name="firstName" placeholder=" الاسم الاول" value=""
                    class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                <input type="text" id="firstName" name="lastName" placeholder=" الاسم الاخير" value=""
                    class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            </div>
            <input type="hidden" id="donorName" name="donor_name" value="" placeholder=" الاسم كامل"
                class="rtl block w-[80%] md:w-[50%] border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
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
            <div class="flex flex-col gap-y-2 items-start justify-start mt-4 mr-[9%] md:mr-0">
                <div class="flex flex-row items-center mb-5 sm:mb-0">
                    <input id="visa" name="notification-method" type="radio" value="visa"
                        class="paymentMethod focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
                    <label for="visa"
                        class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">
                        <span>فيزا كارد</span>
                        <img src="{{ asset('assets/image/visa_1.svg') }}" class="pl-3 w-[52px]" />
                    </label>
                    <!--PayPal -->
                    <input id="masterCard" name="notification-method" type="radio" value="masterCard"
                        class="paymentMethod focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
                    <label for="masterCard"
                        class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">
                        <span>Paypal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48"
                            height="48" viewBox="0 0 48 48" style=" fill:#000000;">
                            <path fill="#1565C0"
                                d="M18.7,13.767l0.005,0.002C18.809,13.326,19.187,13,19.66,13h13.472c0.017,0,0.034-0.007,0.051-0.006C32.896,8.215,28.887,6,25.35,6H11.878c-0.474,0-0.852,0.335-0.955,0.777l-0.005-0.002L5.029,33.813l0.013,0.001c-0.014,0.064-0.039,0.125-0.039,0.194c0,0.553,0.447,0.991,1,0.991h8.071L18.7,13.767z">
                            </path>
                            <path fill="#039BE5"
                                d="M33.183,12.994c0.053,0.876-0.005,1.829-0.229,2.882c-1.281,5.995-5.912,9.115-11.635,9.115c0,0-3.47,0-4.313,0c-0.521,0-0.767,0.306-0.88,0.54l-1.74,8.049l-0.305,1.429h-0.006l-1.263,5.796l0.013,0.001c-0.014,0.064-0.039,0.125-0.039,0.194c0,0.553,0.447,1,1,1h7.333l0.013-0.01c0.472-0.007,0.847-0.344,0.945-0.788l0.018-0.015l1.812-8.416c0,0,0.126-0.803,0.97-0.803s4.178,0,4.178,0c5.723,0,10.401-3.106,11.683-9.102C42.18,16.106,37.358,13.019,33.183,12.994z">
                            </path>
                            <path fill="#283593"
                                d="M19.66,13c-0.474,0-0.852,0.326-0.955,0.769L18.7,13.767l-2.575,11.765c0.113-0.234,0.359-0.54,0.88-0.54c0.844,0,4.235,0,4.235,0c5.723,0,10.432-3.12,11.713-9.115c0.225-1.053,0.282-2.006,0.229-2.882C33.166,12.993,33.148,13,33.132,13H19.66z">
                            </path>
                        </svg>
                    </label>
                    {{-- <input type="radio" id="masterCard" name="fav_language" value="HTML"
                        class="focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
                    <label for="html"
                        class="ml-3 text-md font-medium text-[#201A3C] pr-2 flex flex-row-reverse items-center">فيزا
                        كارد</label><br>
                    <input type="radio" id="css" name="fav_language" value="CSS">
                    <label for="css">CSS</label><br>
                    <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                    <label for="javascript">JavaScript</label> --}}
                </div>

                {{-- אני מאשר/ת את מדיניות ביטולים וגם מדיניות פרטיות --}}
                <div class="flex flex-row items-start sm:items-center mb-5 sm:mb-0">
                    <input id="privecy" name="privecy" type="checkbox" value="privecy"
                        class="focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
                    <label for="privecy"
                        class="tabs ml-3 text-base sm:text-lg font-medium text-[#201A3C] pr-2 flex flex-row flex-wrap gap-x-1 sm:items-center justify-start">
                        <p> אני מאשר/ת </p>
                        <p data-tab="1"
                            class=" text-green-900 px-1  underline text-xl font-extrabold cursor-pointer showModal ">
                            מדיניות ביטולים</p>
                        <p>בנוסף</p>
                        </p>
                        <p data-tab="2"
                            class=" text-green-900 px-1  underline text-xl font-extrabold cursor-pointer showModal ">
                            מדיניות פרטיות</p>
                </div>
            </div>
        </div>
        <div class="">
            @include('Components.ProjectDonations.PrivecySetting')
        </div>
</div>
</form>

<!-- third Page Input -->
<div class="thirdPage mt-24 flex flex-col items-center justify-center hidden">
    @php
        $img = 'storage/' . nova_get_setting('logo', 'default_value');
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
        <button id="firstPageDonations" type="submit"
            class="Ctnbtn rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">متابعة</button>
    </div>
    <div
        class="secondPage mt-10 flex flex-col gap-y-4 md:gap-y-0 md:flex-row items-center justify-start  gap-x-5 hidden">
        <button id="PreviousPageDonations"
            class="rounded-[50px] bg-[#349A37] text-white w-[150px] py-4 font-[700] hover:bg-[#101426] duration-200">الخلف</button>
    </div>
</div>
</div>
