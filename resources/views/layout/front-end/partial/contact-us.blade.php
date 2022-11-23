@php
    $contact_main = nova_get_setting('heder_text_main_Connectus', 'default_value');
    $contact_Text_Main = nova_get_setting('text_main_Connectus', 'default_value');
    $Contact_sub_text = nova_get_setting('sup_text_main_Connectus', 'default_value');
    $phone_contact = nova_get_setting('phone_Connectus', 'default_value');
    $email_contact = nova_get_setting('email_Connectus', 'default_value');
    $name_placeholder = nova_get_setting('filed1_Connectus', 'الاسم كامل');
    $phone_placeholder = nova_get_setting('filed2_Connectus', 'رقم الهاتف');
    $textArea_placeholder = nova_get_setting('filed3_Connectus', 'رسالتك');
    $text_Button = nova_get_setting('text_bottom_Connectus', 'default_value');
    $linlk_bottom_Connectus = nova_get_setting('linlk_bottom_Connectus', 'default_value');
    $whatsapp_phone = nova_get_setting('whatsapp_Connectus', 'default_value');
    $Correct_whatsapp_phone = str_replace(' ', '', $whatsapp_phone);
    $Final_Correct_whatsapp_phone = str_replace('-', '', $Correct_whatsapp_phone);
    $whatsapp_phone_Link = 'https://wa.me/' . $Final_Correct_whatsapp_phone;
    // dd($type)
@endphp

@if($type==1)
<div class="relative z-10 contactusModel" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 top-28 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="tab relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
                <button type="button"
                class="bg-white absolute right-8 top-10 closeModal mr-4 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="sr-only">Close</span>
                <!-- Heroicon name: outline/x -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
                <img class="max-h-[550px] w-full" src="https://media.discordapp.net/attachments/938405759996276806/1042766455139217488/55.jpg?width=468&height=606"
                    alt="donation">
            </div>
        </div>
    </div>
</div>
@endif

<div itemscope itemtype="http://schema.org/LocalBusiness" class="max-w-7xl mx-auto px-0 lg:px-8 mt-8">
    <div class="lg:flex flex-col lg:flex-row justify-center py-4 lg:justify-between  items-center lg:gap-x-10">
        <div class="bg-[#E4FFE585] h-[432px] basis-1/2  flex flex-col pl-3 pr-6 lg:pr-0 relative right-color">
            <p class="text-3xl text-[#101426] pt-10">{{ $contact_main }}</p>
            <p class="text-[#8F9BB3] text-[14px] pt-8"> {{ $contact_Text_Main }}</p>
            <p class="text-[#8F9BB3] text-[16px] pt-3"> {{ $Contact_sub_text }}</p>
            <div class="flex flex-row items-center justify-start gap-x-2 mt-7">
                <img src="{{ asset('assets/image/telephone.svg') }}" alt="telephone" class="max-w-[17px] max-h-[17px]">
                <p itemprop="telephone" dir="ltr" class="text-[#8F9BB3] text-[16px] inter-font">
                    <a> {{ $phone_contact }} </a>
                </p>
            </div>
            <div class="flex flex-row items-center justify-start gap-x-2 mt-2">
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                    style=" fill: currentColor;">
                    <path
                        d="M 24 3.9980469 C 12.972292 3.9980469 4 12.970339 4 23.998047 C 4 27.273363 4.8627078 30.334853 6.2617188 33.064453 L 4.09375 40.826172 C 3.5887973 42.629575 5.3719261 44.41261 7.1757812 43.908203 L 14.943359 41.740234 C 17.670736 43.136312 20.727751 43.998047 24 43.998047 C 35.027708 43.998047 44 35.025755 44 23.998047 C 44 12.970339 35.027708 3.9980469 24 3.9980469 z M 24 6.9980469 C 33.406292 6.9980469 41 14.591755 41 23.998047 C 41 33.404339 33.406292 40.998047 24 40.998047 C 20.998416 40.998047 18.190601 40.217527 15.742188 38.853516 A 1.50015 1.50015 0 0 0 14.609375 38.71875 L 7.2226562 40.779297 L 9.2851562 33.396484 A 1.50015 1.50015 0 0 0 9.1503906 32.261719 C 7.7836522 29.811523 7 27.002565 7 23.998047 C 7 14.591755 14.593708 6.9980469 24 6.9980469 z M 17.240234 15 C 16.921234 15 16.405797 15.119656 15.966797 15.597656 C 15.528797 16.073656 14.294922 17.228125 14.294922 19.578125 C 14.294922 21.928125 16.005141 24.197578 16.244141 24.517578 C 16.482141 24.834578 19.547344 29.812562 24.402344 31.726562 C 28.436344 33.316563 29.256812 32.999922 30.132812 32.919922 C 31.008813 32.841922 32.959422 31.766391 33.357422 30.650391 C 33.755422 29.534391 33.755672 28.579813 33.638672 28.382812 C 33.519672 28.183812 33.200656 28.063219 32.722656 27.824219 C 32.245656 27.585219 29.898937 26.430484 29.460938 26.271484 C 29.022938 26.112484 28.702766 26.031766 28.384766 26.509766 C 28.066766 26.987766 27.152047 28.062859 26.873047 28.380859 C 26.594047 28.700859 26.315891 28.740953 25.837891 28.501953 C 25.358891 28.260953 23.822094 27.757859 21.996094 26.130859 C 20.576094 24.865859 19.620797 23.302219 19.341797 22.824219 C 19.063797 22.348219 19.311781 22.086609 19.550781 21.849609 C 19.765781 21.635609 20.028578 21.292672 20.267578 21.013672 C 20.504578 20.734672 20.583188 20.53675 20.742188 20.21875 C 20.901188 19.90175 20.822125 19.621813 20.703125 19.382812 C 20.584125 19.143813 19.655469 16.780938 19.230469 15.835938 C 18.873469 15.041938 18.49725 15.024719 18.15625 15.011719 C 17.87825 15.000719 17.558234 15 17.240234 15 z" />
                </svg>

                <p itemprop="telephone" dir="ltr" class="text-[#8F9BB3] text-[16px] inter-font">
                    <a href="{{ $whatsapp_phone_Link }}" target="_blank"> {{ $whatsapp_phone }} </a>
                </p>
            </div>
            <div class="flex flex-row items-center justify-start gap-x-2 pt-2">
                <img src="{{ asset('assets/image/message.svg') }}" alt="message" class="max-w-[17px] max-h-[17px]">
                <p dir="ltr" itemprop="email" class="text-[#8F9BB3] text-[16px] inter-font">{{ $email_contact }}
                </p>
            </div>
            <p class="text-[#8F9BB3] text-[16px] font-FlatBold pt-6 pb-4">هل تريد المشاركة بالتبرع؟ <a
                    href="{{ $linlk_bottom_Connectus }}" class="text-[#349A37]" target="_self">{{ $text_Button }}</a>
            </p>
        </div>
        <form target="_self" class="contactUsForm h-[432px] basis-1/2 w-full lg:mr-0">
            @csrf
            <div class=" ltr pt-10 px-6 lg:px-0">
                <input type="text" name="name" placeholder="{{ $name_placeholder }}"
                    class="rtl block w-full  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            </div>
            @error('name')
                <span class="invalid-feedback text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class=" ltr pt-6 px-6 lg:px-0 ">
                <input type="number" name="phone" placeholder="{{ $phone_placeholder }}"
                    class="rtl block w-full border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
            </div>
            @error('phone')
                <span class="invalid-feedback text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="  pt-6 px-6 lg:px-0 ">
                <textarea rows="4" name="message" id="contuctus-message" placeholder="{{ $textArea_placeholder }}"
                    class="w-full inline-flex items-center text-right  justify-center border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4"></textarea>
            </div>
            @error('message')
                <span class="invalid-feedback text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class=" my-4 mr-6 lg:mr-0">
                <button type="submit"
                    class="connectUs duration-200 flex justify-center items-center px-5 lg:px-7 py-3 mt-2 text-[13px] font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                    ارسال
                </button>
            </div>
        </form>
    </div>
</div>
