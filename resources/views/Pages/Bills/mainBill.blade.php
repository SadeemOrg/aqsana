@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false])
@section('content')
    @php
        $whatsapp_phone = nova_get_setting('whatsapp_Connectus', 'default_value');
        $Correct_whatsapp_phone = str_replace(' ', '', $whatsapp_phone);
        $Final_Correct_whatsapp_phone = str_replace('-', '', $Correct_whatsapp_phone);
        $whatsapp_phone_Link = 'https://wa.me/' . $Final_Correct_whatsapp_phone;
    @endphp
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-14 px-2">
        <div class="flex flex-col items-center justify-center mt-40 max-w-4xl mx-auto">
            <img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAEjklEQVRoge3ZW4hWVRQH8J+SU+oUlnT3ocSKtHooqCiKJGoqM7IMIywKpEi7QNFFjTKLsgIfQkkfgsgiEp+6UVjZzUylmykFaUWEdsNuVl7GmR7WPp0zZ765fF/fNzOGf9jMnLXX2nv9z9lr77XXx178fzEZn2InVmFK/7pTGy7FbrQXWhum9adTtWCNcH4OmnFnet6BM/vRr6rxu3C8uSB7PMm2YFR/OFULPhJOzyjI9sHrSb4WQyvYTRBf84/096LGutkzLlN5KR2EjalvSclmgo4xlbWGk5mA1diKd3EtBhf6F6i8lMbht9R3e0G+NsnuwnDcnZ5XN8b9wAVo1fntfSYIwhC8qfJSmih2tVa0JNmOpNuUnpvS8/ZGkYD30iSzMAxXypdMO97CqRiJTSovpeyN/yRIZ7ZFVJLVFVvTBMMLsibcjB/l58ZSES/ZLlZcSoOwIcnP6MLphhP5IE0wMzlUxAF4ANuSzk58lf5vxWkF3SyOZnXhdMOJXCiPkTUYX0HncCzGLh3jaH5BZ3KSvaafiBAB/21hsldwUgW9E+RLsR0fF/oOEUtwm34kQsTFrfglTbhbxMXokl52rmQ6Iwt9G3T8YkX0GZEMI8WS2Z4m/hv3l3QWFRybVJAvNICIZDgaz4rl0o7rC31DsT7JHy3IrzAAiWSYmhz4S5zkGcbiHVxckB0qJz7giMCTyYn14tDsDssNICJnYYWIj3LqMq8H2xEinXmxJO9zIlN1Pi+Ku9TsGsftUyLXya+183BgHcfuMyLT5CRqfevdoU+I3CjfbW5r0BwNJ3KLINEmTvYiWvAcHhKxc4qOWXI12CyIPFyjfbdokZO4qdR3uch2ywHfhm/wqriHlDPmrnC+PFuY+V8dL2NVGviOknyKfOdahLl4Hp8UnMnaxCrmm1QYd0YPulUhy2RHFGRT5Wn93Ao2g0Ui+VjSWVXlnFeLTWU3rqnStktkX2Q29hfxku1c9/Zg24yfk+65Vc47Pdnt0jHprBlZjJTjoLfb7z1J/40a5i7e8/8zjhElmjKRD3F2L+xH4Ndkc3oN89dtS/6hMNiX4pq6RX4/b+na9F88mPTLuVVvUDciL6eBnirI9sUTSb5Fz2nKePm2XG1KUzciJycH/hQFhgyDRcWxXRQdusKx+D7pLath/rqe9svSYAtK8uNEGt+mcmVlFL5OtsvFl6wWdSUyVpwbO3BUqW9OmmgrXsB9oow6Dl+kvrf1fNnqCnXPv57WOVaIt/y+zrta1taIIl6tqDuR0WKXasXxFfqPxCWimvISvsNKHUtBtaAhGXFW4lla74G7QUOIHCEqJW2i+t4XaNgdZX4aeIXIvRqNhhE5WJ5ybBaZam/vG7WgobfGE0XhLZtkpTg4K2EIzsEjyWajOHt2ifTnc3HDvEEcnmU0/Po7CFeJ3SkrAy0WZ84wkSAulBe8e9vWicx6TF8RydAsykLZb4KV2npR/z1PvPVhorJ/mPhpYrq4XZZJr9WHRDKMEYnkJnHKrxPLaVx3RiU0iWvxEvkvwdnX3mOxn7gZPiMqNHuxR+EfPy/DQuFyLnAAAAAASUVORK5CYII=">
            <h2 class="mt-2 font-FlatBold text-center text-3xl">يوفي!
                @if ($type == 1)
                    سند القبض
                @else
                    فاتورة
                @endif
                رقم F-1000{{ $id }} تم انتاجة بنجاح
            </h2>
            <h3 class="mt-4 font-FlatBold text-center text-xl ">تم ارسال الملف للايمال الحاص بك, وتم ارسال ايميل
                للشخص المتبرع في
                حالو وجود ايميل خاص به ,ايضا نسخة عن الملف تم حفظه في المنظومه</h3>
            <div class="flex flex-row items-center justify-between w-full mt-6">

                <div class="flex flex-col items-center justify-center basis-2/6 border-l-2  border-gray-500  gap-y-3">
                    <img src="{{ asset('assets/image/paper-plane.png') }}" class="w-8 h-8 " alt="">
                    <h3 class="font-FlatBold text-center text-xl">تم ارسال الملف للايمال التالي</h3>
                    <h3 class="font-FlatBold text-center text-lg">alqudsquds@gmail.com</h3>
                </div>

                <div onclick="location.href='{{ route('originalbill', ['id' => $id]) }}'"
                    class="flex flex-col justify-center items-center border-l-2 basis-1/5 border-gray-500 gap-y-3">
                    <img src="{{ asset('assets/image/pdf.png') }}" class="w-8 h-8 " alt="">
                    <h3 class="font-FlatBold text-center text-xl">نسخة أصلية</h3>
                </div>


                <div onclick="location.href='{{ route('bill', ['id' => $id]) }}'"
                    class="flex flex-col justify-center items-center border-l-2 basis-1/5 border-gray-500 gap-y-3">
                    <img src="{{ asset('assets/image/pdf.png') }}" class="w-8 h-8 " alt="">
                    <h3 class="font-FlatBold text-center text-xl">نسخة عن الأصلية</h3>
                </div>

                <a href="https://api.whatsapp.com/send?text=https://alaqsa.avero.tech/mainbill/{{ $id }}" class="flex flex-col justify-center items-center basis-1/5  gap-y-3">
                    <img src="{{ asset('assets/image/whatsappbill.png') }}" class="w-8 h-8 " alt="">
                    <h3 class="font-FlatBold text-center text-xl">ارسال عن طريق الواتس اب</h3>
                </a>

            </div>
        </div>
    </div>
@endsection
