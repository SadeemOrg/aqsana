@extends('layout.app')
@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 px-2">
    <div class="flex sm:flex-row flex-col-reverse items-center justify-between">
        <div class="basis-1/2">
            <h3 class="mt-8 text-4xl font-FlatBold text-[#101426]">ארגון אקצא</h3>
            <p class="mt-2 text-[19px] font-noto_Regular text-[#6B7280]">לפתח את נכסי ההקדש האיסלאמי</p>
            <p class=" mt-3 text-[17px] font-noto_Regular text-[#101426]">אִרגוּן :
                <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">123456</span>
            </p>
            <p class=" text-[17px] font-noto_Regular text-[#101426]">כותרת :
                <span class="font-FlatBold text-[#6B7280] mx-1 ">טלפון</span>
            </p>
            <p class=" text-[17px] font-noto_Regular text-[#101426]">טלפון :
                <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">0507274834</span>
            </p>
            <p class=" text-[17px] font-noto_Regular text-[#101426]">אימייל
                <span class="font-FlatBold text-[#6B7280] mx-1 text-sm">Alaqsaqudus@gmail.com</span>
            </p>
        </div>
        <div class="flex basis-1/2 justify-center">
            <img src="{{asset('assets/image/2SG4XFNXK4WfehAE1eroA7kp7Y341RMs8f4ObPLO.png')}}" class="w-48 h-48 " alt="">
        </div>
    </div>
    <div class="flex flex-col items-center mt-10">
        <p class="">05/09/3033</p>
        <p class="font-FlatBold text-[20px] text-[#101426] ">קבלה מספר
            <span class="text-base">
                30607
            </span>
        </p>
        <p class="font-FlatBold text-[20px] text-[#101426] ">עותק קשיח של המקור</p>
    </div>
    <div class="flex flex-row items-center xl:justify-between justify-start gap-x-10 max-w-xl mt-4">
        <p class="text-[18px] font-FlatBold text-[#101426]">חשבון עבור :</p>
        <span class="font-FlatBold text-[#6B7280] mx-1 text-[19px]">לפתח את נכסי ההקדש</span>
    </div>
    <p class="font-FlatBold text-[#101426] mt-3 text-[22px]">התשלום בוצע דרך :</p>


    <!-- table -->

    <div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-[#349A37]">
              <tr class="">
                <th scope="col" class=" py-3.5 pl-4 pr-3  text-sm font-semibold text-white text-right sm:pl-6">שיטות תשלום</th>
                <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">תאריך</th>
                <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">בַּנק</th>
                <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">בַּנק</th>
                <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">מספר חשבון</th>
                <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">מס מחיה</th>
                <th scope="col" class="px-3 py-3.5  text-sm font-semibold text-white text-right">סך הכל</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-[#E4FFE585]">
              <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">חשבון</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">26/08/2022</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">12</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">632</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">161479</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">00120006</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">5.000 ₪</td>
              </tr>
              <tr>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
              <td class="whitespace-nowrap px-3 py-4  font-FlatBold text-lg">סך הכל סופי :</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
              <td class="whitespace-nowrap px-3 py-4 font-FlatBold text-lg">5.000 ₪</td>
              </tr>

              <!-- More people... -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



</div>
@endsection