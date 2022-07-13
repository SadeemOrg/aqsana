@php
// dd(request()->path());
if (request()->path()== '/' || request()->path() == 'about-us' ){
    $contact_main = nova_get_setting('heder_text_main_Connect', 'default_value');
    $contact_Text_Main = nova_get_setting('text_main_Connect', 'default_value');
    $Contact_sub_text = nova_get_setting('sup_text_main_Connect', 'default_value');
    $phone_contact = nova_get_setting('phone_Connect', 'default_value');
    $email_contact = nova_get_setting('email_Connect', 'default_value');
    $text_Button = nova_get_setting('text_bottom_Connect', 'default_value');
    $name_placeholder = nova_get_setting('filed1_Connect', 'default_value');
    $phone_placeholder = nova_get_setting('filed2_Connect', 'default_value');
    $textArea_placeholder = nova_get_setting('filed3_Connect', 'default_value');
    $text_Button = nova_get_setting('text_bottom_Connect', 'default_value');
    // dd($name_placeholder);
}
elseif (request()->path() == 'contact-us'){
$contact_main = nova_get_setting('heder_text_main_Connectus', 'default_value');
$contact_Text_Main = nova_get_setting('text_main_Connectus', 'default_value');
$Contact_sub_text = nova_get_setting('sup_text_main_Connectus', 'default_value');
$phone_contact = nova_get_setting('phone_Connectus', 'default_value');
$email_contact = nova_get_setting('email_Connectus', 'default_value');
$name_placeholder = nova_get_setting('filed1_Connectus', 'default_value');
$phone_placeholder = nova_get_setting('filed2_Connectus', 'default_value');
$textArea_placeholder = nova_get_setting('filed3_Connectus', 'default_value');
$text_Button = nova_get_setting('text_bottom_Connectus', 'default_value');
}

@endphp
<div itemscope itemtype="http://schema.org/LocalBusiness" class="max-w-7xl mx-auto px-0 lg:px-8 mt-8">
    <div class="lg:flex flex-col lg:flex-row justify-center py-4 lg:justify-between  items-center lg:gap-x-10">
        <div class="bg-[#E4FFE585] h-[432px] basis-1/2  flex flex-col pl-3 pr-6 lg:pr-0 relative right-color">
            <p class="text-3xl text-[#101426] pt-10">{{ $contact_main }}</p>
            <p class="text-[#8F9BB3] text-[14px] pt-8"> {{ $contact_Text_Main }}</p>
            <p class="text-[#8F9BB3] text-[16px] pt-3"> {{ $Contact_sub_text }}</p>
            <p class="text-[#8F9BB3] text-[16px] ">of the printing and</p>
            <div class="flex flex-row items-center justify-start gap-x-2 mt-7">
                <img src="{{ asset('assets/image/telephone.svg') }}" alt="telephone" class="max-w-[17px] max-h-[17px]">
                <p itemprop="telephone" dir="ltr" class="text-[#8F9BB3] text-[16px] inter-font">
                    <a href={{ $phone_contact }}> {{ $phone_contact }} </a>
                </p>
            </div>
            <div class="flex flex-row items-center justify-start gap-x-2 pt-2">
                <img src="{{ asset('assets/image/message.svg') }}" alt="message" class="max-w-[17px] max-h-[17px]">
                <p dir="ltr" itemprop="email" class="text-[#8F9BB3] text-[16px] inter-font">{{ $email_contact }}</p>
            </div>
            <p class="text-[#8F9BB3] text-[16px] font-FlatBold pt-6 pb-4">هل تريد المشاركة بالتبرع؟ <a href="#"
                    class="text-[#349A37]">{{ $text_Button }}</a></p>
        </div>
        <form method="get" action="{{ route('conctus') }}" class=" h-[432px] basis-1/2 w-full lg:mr-0">
            @csrf
            <div class=" ltr pt-10 px-6 lg:px-0">
                <input type="text" name="name" placeholder="{{ $name_placeholder }}"
                    class="rtl block w-full  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class=" ltr pt-6 px-6 lg:px-0">
                <input type="text" name="phone" placeholder="{{ $phone_placeholder }}"
                    class="rtl block w-full border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            </div>
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="  pt-6 px-6 lg:px-0">
                <textarea rows="4" name="message" id="order_note" placeholder="{{ $textArea_placeholder }}" required=""
                    class="w-full inline-flex items-center text-right  justify-center border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4"></textarea>
            </div>
            @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class=" my-4 mr-6 lg:mr-0">
                <button type="submit" {{-- onclick="location.href='{{route('product',$bestSell->slug)}} '" --}}
                    class="duration-200 flex justify-center items-center px-5 lg:px-7 py-3 mt-2 text-[13px] font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                    ارسال
                </button>
            </div>
        </form>
    </div>
</div>
