<style>
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>

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
@endphp

@if ($type == 1)
    <div itemscope itemtype="http://schema.org/LocalBusiness" class="max-w-7xl mx-auto px-0 lg:px-8 mt-12">
        <div class="lg:flex flex-col lg:flex-row justify-center md:gap-y-0 gap-y-4 lg:justify-start  items-center lg:gap-x-10">
            <!--First Component -->
            <div class=" md:h-[432px] basis-1/3 -mx-2 flex flex-col pl-3 pr-6 lg:pr-0 relative bg-[#FCFCFC]">
                <div class="relative">
                    <p itemprop="name" class="text-3xl text-[#101426] pt-10 px-2"> {{ $contact_main }}</p>
                    <div class="absolute border-b-[4px] mr-2 pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
                </div>
                <p class="text-[#8F9BB3] text-[14px] pt-8 px-2"> {{ $contact_Text_Main }}</p>
                <p class="text-[#8F9BB3] text-[16px] pt-3 px-2"> {{ $Contact_sub_text }}</p>
                <div class="flex flex-row items-center justify-start gap-x-2 mt-7 px-2">
                    <img src="{{ asset('assets/image/telephone.svg') }}" alt="telephone"
                        class="max-w-[17px] max-h-[17px]">
                    <p itemprop="telephone" dir="ltr" class="text-[#8F9BB3] text-[16px] inter-font">
                        <a> {{ $phone_contact }} </a>
                    </p>
                </div>
                <div class="flex flex-row items-center justify-start gap-x-2 mt-2 px-2">
                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                        style=" fill: currentColor;">
                        <path
                            d="M 24 3.9980469 C 12.972292 3.9980469 4 12.970339 4 23.998047 C 4 27.273363 4.8627078 30.334853 6.2617188 33.064453 L 4.09375 40.826172 C 3.5887973 42.629575 5.3719261 44.41261 7.1757812 43.908203 L 14.943359 41.740234 C 17.670736 43.136312 20.727751 43.998047 24 43.998047 C 35.027708 43.998047 44 35.025755 44 23.998047 C 44 12.970339 35.027708 3.9980469 24 3.9980469 z M 24 6.9980469 C 33.406292 6.9980469 41 14.591755 41 23.998047 C 41 33.404339 33.406292 40.998047 24 40.998047 C 20.998416 40.998047 18.190601 40.217527 15.742188 38.853516 A 1.50015 1.50015 0 0 0 14.609375 38.71875 L 7.2226562 40.779297 L 9.2851562 33.396484 A 1.50015 1.50015 0 0 0 9.1503906 32.261719 C 7.7836522 29.811523 7 27.002565 7 23.998047 C 7 14.591755 14.593708 6.9980469 24 6.9980469 z M 17.240234 15 C 16.921234 15 16.405797 15.119656 15.966797 15.597656 C 15.528797 16.073656 14.294922 17.228125 14.294922 19.578125 C 14.294922 21.928125 16.005141 24.197578 16.244141 24.517578 C 16.482141 24.834578 19.547344 29.812562 24.402344 31.726562 C 28.436344 33.316563 29.256812 32.999922 30.132812 32.919922 C 31.008813 32.841922 32.959422 31.766391 33.357422 30.650391 C 33.755422 29.534391 33.755672 28.579813 33.638672 28.382812 C 33.519672 28.183812 33.200656 28.063219 32.722656 27.824219 C 32.245656 27.585219 29.898937 26.430484 29.460938 26.271484 C 29.022938 26.112484 28.702766 26.031766 28.384766 26.509766 C 28.066766 26.987766 27.152047 28.062859 26.873047 28.380859 C 26.594047 28.700859 26.315891 28.740953 25.837891 28.501953 C 25.358891 28.260953 23.822094 27.757859 21.996094 26.130859 C 20.576094 24.865859 19.620797 23.302219 19.341797 22.824219 C 19.063797 22.348219 19.311781 22.086609 19.550781 21.849609 C 19.765781 21.635609 20.028578 21.292672 20.267578 21.013672 C 20.504578 20.734672 20.583188 20.53675 20.742188 20.21875 C 20.901188 19.90175 20.822125 19.621813 20.703125 19.382812 C 20.584125 19.143813 19.655469 16.780938 19.230469 15.835938 C 18.873469 15.041938 18.49725 15.024719 18.15625 15.011719 C 17.87825 15.000719 17.558234 15 17.240234 15 z" />
                    </svg>

                    <p itemprop="telephone" dir="ltr" class="text-[#8F9BB3] text-[16px] inter-font">
                        <a href="{{ $whatsapp_phone_Link }}" target="_blank"> {{ $whatsapp_phone }} </a>
                    </p>
                </div>
                <div class="flex flex-row items-center justify-start gap-x-2 pt-2 px-2">
                    <img src="{{ asset('assets/image/message.svg') }}" alt="message" class="max-w-[17px] max-h-[17px]">
                    <p dir="ltr" itemprop="email" class="text-[#8F9BB3] text-[16px] inter-font">
                        {{ $email_contact }}
                    </p>
                </div>
                <p class="text-[#8F9BB3] text-[16px] font-FlatBold pt-6 pb-4 px-2">هل تريد المشاركة بالتبرع؟ <a
                        href="{{ $linlk_bottom_Connectus }}" class="text-[#349A37]"
                        target="_self">{{ $text_Button }}</a>
                </p>
            </div>
            <!--End First Component -->

            <!--Start Second Component pay By -->
            <div class=" md:h-[432px] basis-1/3 -mx-2 flex flex-col pl-3 pr-6 lg:pr-0 relative bg-[#FCFCFC]">
                <div class="relative">
                    <p itemprop="name" class="text-3xl text-[#101426] pt-10 px-2"> طرق الدفع</p>
                    <div class="absolute border-b-[4px] mr-2 pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
                </div>
                <div class="flex flex-row items-center justify-start gap-x-2 mt-7 px-2">
                    <img src="{{ asset('assets/image/BIT.svg') }}" alt="telephone" class="max-w-[42px] max-h-[22px]">

                    <p itemprop="telephone"  class="font-FlatBold text-[#101426] text-[16px] ">
                        بواسطة تطبيق : <a dir="ltr">050-6940095</a>
                    </p>
                </div>
                <div class="flex flex-row items-center justify-start gap-x-2 mt-2 px-2">
                    <img src="{{ asset('assets/image/visa_2.svg') }}" alt="telephone"
                        class="max-w-[39px] max-h-[39px]">

                    <p itemprop="telephone" dir="ltr" class="font-FlatBold text-[#101426] text-[16px] ">
                        التبرع عن طريق بطاقة الائتمان
                    </p>
                </div>
                <div class="flex flex-row items-center justify-start gap-x-2 pt-2 px-2">
                    <img src="{{ asset('assets/image/lume.svg') }}" alt="message" class="max-w-[65px] max-h-[25px]">
                    <p dir="ltr" itemprop="email" class="font-FlatBold text-[#101426] text-[16px]">
                        بنك ليثومي فرع 757 حساب رقم 1452243
                    </p>
                </div>
            </div>
            <!--End Second Component pay By -->
            <!--Start third Component pay By -->
            <div class=" md:h-[432px] basis-1/3 -mx-2 flex flex-col pl-3 pr-6 lg:pr-0 relative bg-[#FCFCFC]">
                <div class="relative">
                    <p itemprop="name" class="text-3xl text-[#101426] pt-10 px-2"> بيانات الدفع</p>
                    <div class="absolute border-b-[4px] mr-2 pt-2 border-b-[#349A37] w-9 hidden xl:block"></div>
                </div>
                <!--Start Pay Pal Radio -->
                <div class="flex flex-row items-center justify-start mt-6">
                    <input id="payPalv1" name="PaypalRadioInput" type="radio" value="payPalv1"
                        class="paymentMethod focus:ring-[#349A37] bg-gray h-4 w-4 text-[#349A37] border-gray-300 relative" />
                    <label for="payPalv1"
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
                </div>
                <!--End Pay Pal Radio -->
                <!--Start Form For PayPal -->
                <form target="_self" class="payPalDonationsForm w-full flex flex-col items-start justify-start">
                    <div class="mt-3 w-[90%]">
                        <label for="PayPal_donation_amount" class="block text-sm font-medium text-gray-700 pr-1">المبلغ
                            المراد التبرع
                            به</label>
                        <div class="mt-2 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm"> ₪ </span>
                            </div>
                            <input type="number" name="PayPal_donation_amount" id="PayPal_donation_amount"
                                class="focus:ring-green-500 focus:border-green-500 block  sm:text-sm border-gray-300 rounded-md w-full"
                                placeholder="0.00" aria-describedby="price-currency">
                        </div>
                    </div>
                    <div class="mt-3 w-[90%]">
                        <input type="text" name="namePayPal" id="namePayPal"
                            class="focus:ring-green-500 focus:border-green-500 block mt-1 sm:text-sm border-gray-300 rounded-md w-full"
                            placeholder="الاسم الكامل" aria-describedby="price-currency">
                    </div>
                    <div class="mt-3 w-[90%]">
                        <input type="email" name="EmailPayPal" id="EmailPayPal"
                            class="focus:ring-green-500 focus:border-green-500 block mt-1 sm:text-sm border-gray-300 rounded-md w-full"
                            placeholder="البريد الالكتروني" aria-describedby="price-currency">
                    </div>
                    <div id="paypal-button-container" class="mt-6"></div>
            </div>
            </form>
            <!--End Form For PayPal -->
        </div>
        <!--End third Component pay By -->

    </div>
    
@else
    <div itemscope itemtype="http://schema.org/LocalBusiness" class="max-w-7xl mx-auto px-0 lg:px-8 mt-12">
        <div class="lg:flex flex-col lg:flex-row justify-center lg:justify-between  items-center lg:gap-x-10">
            <div class="bg-[#E4FFE585] h-[432px] basis-1/2  flex flex-col pl-3 pr-6 lg:pr-0 relative right-color">
                <p class="text-3xl text-[#101426] pt-10">{{ $contact_main }}</p>
                <p class="text-[#8F9BB3] text-[14px] pt-8"> {{ $contact_Text_Main }}</p>
                <p class="text-[#8F9BB3] text-[16px] pt-3"> {{ $Contact_sub_text }}</p>
                <div class="flex flex-row items-center justify-start gap-x-2 mt-7">
                    <img src="{{ asset('assets/image/telephone.svg') }}" alt="telephone"
                        class="max-w-[17px] max-h-[17px]">
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
                    <img src="{{ asset('assets/image/message.svg') }}" alt="message"
                        class="max-w-[17px] max-h-[17px]">
                    <p dir="ltr" itemprop="email" class="text-[#8F9BB3] text-[16px] inter-font">
                        {{ $email_contact }}
                    </p>
                </div>
                <p class="text-[#8F9BB3] text-[16px] font-FlatBold pt-6 pb-4">هل تريد المشاركة بالتبرع؟ <a
                        href="{{ $linlk_bottom_Connectus }}" class="text-[#349A37]"
                        target="_self">{{ $text_Button }}</a>
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
                <div class=" mt-4 mr-6 lg:mr-0">
                    <button type="submit"
                        class="connectUs duration-200 flex justify-center items-center px-5 lg:px-7 py-3 mt-2 text-[13px] font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                        ارسال
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
