<div class="mt-24 flex flex-col items-center justify-center">
    @php
    $img = 'storage/'. nova_get_setting('logo', 'default_value');
@endphp
<img class="w-[370px] h-24" src="/{{ $img }}" alt="logo">
<p class="text-[30px] max-w-md mt-8">
    تم التبرع بنجاح لصالح مشروع اسم المشروع بمبلغ قدره
    <span class="text-[#349A37]">500 شيكل </span>
</p>
<a target="_self" class="bg-[#349A37] mt-5 hover:bg-[#101426] duration-200 py-3 px-4 ml-2 text-white  rounded-[50px] text-lg  " href="/">الصفحة الرئيسية</a>

</div>
