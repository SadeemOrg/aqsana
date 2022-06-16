
<div class=" mt-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-0 lg:px-8 mt-8">
        <div class="lg:flex flex-col lg:flex-row justify-center py-4 lg:justify-between  items-center lg:gap-x-10">
            <div class="bg-[#E4FFE585] h-[432px] basis-1/2  flex flex-col pl-3 pr-6 lg:pr-0 relative right-color">
                <p class="text-3xl text-[#101426] pt-10">تواصل معنا</p>
                <p class="text-[#8F9BB3] text-[16px] font-Flatnormal pt-8">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                    لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص
                    أو شكل توضع الفقرات في الصفحة التي يقرأها.</p>
                <p class="text-[#8F9BB3] text-[16px] font-Flatnormal pt-3"> simply dummy text of the printing and</p>
                <p class="text-[#8F9BB3] text-[16px] font-Flatnormal ">of the printing and</p>
                <div class="flex flex-row items-center justify-start gap-x-2 mt-7">
                    <img src="{{ asset('assets/image/telephone.svg') }}" alt="telephone">
                    <p dir="ltr" class="text-[#8F9BB3] text-[16px] font-Flatnormal">+972-599-043-747</p>
                </div>
                <div class="flex flex-row items-center justify-start gap-x-2 pt-2">
                    <img src="{{ asset('assets/image/message.svg') }}" alt="message">
                    <p dir="ltr" class="text-[#8F9BB3] text-[16px] font-Flatnormal">support@example.com</p>
                </div>
                <p class="text-[#8F9BB3] text-[16px] font-FlatBold pt-6 pb-4">هل تريد المشاركة بالتبرع؟ <a href="#"
                        class="text-[#349A37]">تبرع الان</a></p>
            </div>
            <div class=" h-[432px] basis-1/2 w-full lg:mr-0">
                    <div class=" ltr pt-10 px-6 lg:px-0">
                        <input type="text" name="" placeholder=" الاسم الكامل"
                            class="rtl block w-full  border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class=" ltr pt-6 px-6 lg:px-0">
                        <input type="text" name="" placeholder="رقم الهاتف"
                            class="rtl block w-full border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">
                    </div>
                    <div class="  pt-6 px-6 lg:px-0">
                        <textarea rows="4" name="order_note" id="order_note" placeholder="ملاحظة" required=""
                            class="w-full inline-flex items-center text-right  justify-center border-[#A2A6B0] border rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4"></textarea>
                    </div>
                <div class=" my-4 mr-6 lg:mr-0">
                    <button type="button" {{-- onclick="location.href='{{route('product',$bestSell->slug)}} '" --}}
                        class="duration-200 flex justify-center items-center px-5 lg:px-7 py-3 mt-2 text-[13px] font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-black hover:text-white ">
                        اشتري الأن
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
