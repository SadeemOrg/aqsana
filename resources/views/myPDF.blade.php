<!DOCTYPE html>
<html>

<head>
    <title>Whatsapp Bills</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
    .container {
        max-width: 1280px;
        margin: 64px auto;
    }

    .container .img_logo {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin-top: 36px;
    }

    .container .img_logo .logo {
        height: 600px;
        width: 90%;
    }

    .right_titleSilde {
        display: flex;
        flex-direction: column-reverse;
        align-items: center;
        justify-content: space-between;
    }

    .right_titleSilde .right_titleSilde_Container {
        flex-basis: 50%;
    }

    .first_text {
        margin-top: 8px;
        font-size: 17px;
        color: #101426'

    }

    .second_text {
        font-size: 12px;
        color: #6B7280;
        margin: 0 4px;
    }

    @media screen and (min-width: 640px) {
        .right_titleSilde {
            flex-direction: row;
        }
    }
</style>
<body>
    @php
        define('DOMPDF_ENABLE_REMOTE', false);
        $society_id = nova_get_setting('society_id', '580179794');
        $phone = nova_get_setting('phone', 'default_value');
        $email = nova_get_setting('email', 'default_value');
        $address = nova_get_setting('address', 'default_value');
        $newaddress = explode(',', $address);

    @endphp
    <div class="container">
        <div class="img_logo">
            <img class="logo" {{-- src="{{ asset('./assets/image/AlaqsaSun.png') }}" --}} />
        </div>
        @if ($lang == 1 || $lang == 3)
            <div class="right_titleSilde ">
                <div class="right_titleSilde_Container">
                    <p class="first_text ">رقم الجمعية :
                        <span class="second_text ">{{ $society_id }}</span>
                    </p>
                    <p class="first_text ">العنوان :
                        <span class="second_text  ">{{ $newaddress[0] }}</span>
                    </p>
                    <p class="first_text ">رقم الهاتف :
                        <span dir="ltr" class="second_text ">{{ $phone }}</span>
                    </p>
                    <p class="first_text ">البريد الالكتروني :
                        <span class="second_text ">{{ $email }}</span>
                    </p>
                </div>
            </div>
            {{-- <div class="flex flex-col items-center mt-10">
                <p dir="ltr" class="">{{ $newDate[0] }}</p>
                <p class="font-FlatBold text-[17px] text-[#101426] ">سند قبض رقم
                    <span class="text-base">
                        F-1000{{ $Transaction->id }}
                    </span>
                </p>
                @if ($original == 1)
                    <p class="font-FlatBold text-[17px] text-[#101426] "> النسخة ألاصلية</p>
                @else
                    <p class="font-FlatBold text-[17px] text-[#101426] ">نسحة عن النسخة ألاصلية</p>
                @endif
            </div>
            <div class="flex flex-row items-center xl:justify-start justify-start gap-x-4 max-w-xl mt-4">
                <p class="text-[18px] font-FlatBold text-[#101426]">لحساب :</p>
                <span class="font-FlatBold text-[#6B7280]  text-[18px] text-right">
                    {{ $Transaction->TelephoneDirectory->name }}
                </span>
            </div> --}}
        @endif
    </div>
</body>

</html>
