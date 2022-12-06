@extends('layout.app', ['hasHeader' => true, 'hasFooter' => true, 'left_SideBar' => false])

@section('content')
    @php
        // dd($user);
        $name = '@' . $user['name'];
        $newDate = date('d-m-Y', strtotime($user['birth_date']));
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex sm:flex-row flex-col sm:gap-y-0 gap-y-6 items-center justify-between mt-4 xl:mt-8">
            <div class="relative ">
                <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right"> لوحة التحكم</p>
                <div class="absolute border-b-[4px] pt-2 border-b-[#349A37]  w-28 hidden xl:block"></div>
            </div>
            <button onclick="location.href='/'"
                class=" Ctnbtn rounded-[50px] bg-transparent text-[#349A37] border-[1px] border-[#349A37]  text-base w-[204px] py-4 font-[700] hover:bg-[#349A37] hover:text-white duration-200">الذهاب
                الى المنظومة</button>
        </div>
        <!--Tabs -->
        <div class="mt-12">
            <div class="block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <a href="#" target="_self"
                            class="border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/4 py-4 px-1 text-center border-b-2 font-FlatBold text-[16px]">التفاصيل
                            الشخصية</a>
                        <a href="#" target="_self"
                            class="border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/4 py-4 px-1 text-center border-b-2 font-FlatBold text-[16px]">ساعات
                            العمل</a>
                    </nav>
                </div>
            </div>
        </div>
        <!--Perosonal Information -->

        <div class="flex flex-row items-center justify-between mt-8">
            <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">البيانات الشخصية</p>
            <div class="flex flex-row items-center  gap-x-2 ">
                <div class="relative">
                    <button onclick=" document.getElementById('button_form').click();"
                        class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                        تعديل
                    </button>
                    <svg class=" absolute top-5 right-4" width="17" height="17" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1042_277)">
                            <path
                                d="M12.3511 3.35913L1.3468 14.3642C1.29144 14.4197 1.25146 14.4898 1.23242 14.5652L0.0127046 19.4609C-0.0237807 19.6083 0.0195258 19.765 0.127078 19.8725C0.208456 19.9539 0.31934 19.999 0.432762 19.999C0.467502 19.999 0.503035 19.9947 0.537617 19.986L5.43331 18.7661C5.50961 18.747 5.57893 18.7072 5.6343 18.6519L16.6395 7.64758L12.3511 3.35913Z"
                                fill="white" />
                            <path
                                d="M19.3659 1.8587L18.141 0.633746C17.3223 -0.184952 15.8954 -0.184159 15.0776 0.633746L13.5771 2.13424L17.8654 6.42254L19.3659 4.92204C19.7749 4.51324 20.0001 3.96914 20.0001 3.39045C20.0001 2.81176 19.7749 2.26765 19.3659 1.8587Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1042_277">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="relative">
                    <button
                        class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#349A37] hover:bg-[#101426] hover:text-white ">
                        حفظ
                    </button>
                    <svg class="absolute top-5 right-4" width="16" height="20" viewBox="0 0 16 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.8337 0H2.2295C1.28441 0 0.45459 0.777477 0.45459 1.69775V18.8639C0.45459 19.172 0.540326 19.4287 0.678505 19.6271C0.843753 19.8642 1.10983 20.0001 1.39514 20C1.6649 20 1.9521 19.8799 2.21733 19.6534L7.40906 15.2453C7.5694 15.1084 7.79973 15.0299 8.03921 15.0299C8.27859 15.0299 8.50845 15.1084 8.66926 15.2457L13.8436 19.6527C14.1098 19.8799 14.3772 20.0001 14.6465 20.0001C15.1019 20.0001 15.5457 19.6488 15.5457 18.864V1.69775C15.5457 0.777477 14.7788 0 13.8337 0Z"
                            fill="white" />
                    </svg>
                </div>
            </div>
        </div>
        {{-- <div class="flex flex-row items-center justify-center">
            <img class="inline-block h-40 w-40 mt-6 rounded-full"
                src="https://media.discordapp.net/attachments/938405759996276806/1042005410330202152/zey.jpg"
                alt="">
        </div> --}}
        @php
            $img = 'storage/' . $user['photo'];
        @endphp
        <form method="POST" action="{{ '/user/update' }}" enctype="multipart/form-data" class="mt-8">
            @csrf
            <div class="flex flex-row items-center justify-center">
                <img src="/{{ $img }}" alt="" class="inline-block h-40 w-40 mt-6 rounded-full"
                    id="chosen" onclick=" document.getElementById('user_image_uploader').click();">
                <input type="file" name="image" id="user_image_uploader" onchange="readURL('chosen', this);" hidden />
            </div>


            <!--Form -->

            <div class="mt-8">

                <section class="border-b-2 max-w-7xl border-[#9CA9B6] pb-12">
                    <!--first div Dev -->
                    <div
                        class="flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                        <div class="">
                            <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الاسم </label>
                            <div class="mt-1">
                                <input type="text" name="name" placeholder=" الاسم" value={{ $user['name'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الوظيفة </label>
                            <div class="mt-1">
                                <input type="text" name="jop" placeholder=" الوظيفة" value={{ $user['jop'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">

                            </div>
                        </div>
                        <div class="">
                            <label for="email" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> البريد الالكتروني
                            </label>
                            <div class="mt-1">
                                <input type="text" name="email" placeholder=" الاسم" value={{ $user['email'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="phone" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم الهاتف
                            </label>
                            <div class="mt-1">
                                <input type="text" name="phone" placeholder=" رقم التلفون" value={{ $user['phone'] }}
                                    class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                    </div>
                    <!--Second Dev -->
                    <div
                        class="mt-8 flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                        <div class="">
                            <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> تاريخ الميلاد
                            </label>
                            <div class="mt-1">
                                <input type="text" name="birth_date" placeholder=" الاسم" value={{ $newDate }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم الهوية
                            </label>
                            <div class="mt-1">
                                <input type="text" name="id_number" placeholder="الوظيفة"
                                    value={{ $user['id_number'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="email" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> بدء العمل
                                بالجمعية
                            </label>
                            <div class="mt-1">
                                <input type="text" name="start_work_date" placeholder=" الاسم"
                                    value={{ $user['start_work_date'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="phone" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> المدينة
                            </label>
                            <div class="mt-1">
                                <input type="text" name="city" placeholder=" رقم التلفون" value={{ $user['city'] }}
                                    class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                    </div>
                    <!--third Dev -->
                    <div
                        class="mt-8 flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                        <div class="">
                            <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الحالة
                                الاجتماعية
                            </label>
                            <div class="mt-1">
                                <input type="text" name="martial_status" placeholder=" الاسم"
                                    value={{ $user['martial_status'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        {{-- <div class="">
                        <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> تاريخ المغادرة
                        </label>
                        <div class="mt-1">
                            <input type="text" name="" placeholder="الوظيفة" value={{ $user['name'] }}
                                class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                        </div>
                    </div> --}}
                    </div>
                </section>
                <!--Second Section -->
                <section class="border-b-2 max-w-7xl border-[#9CA9B6] pb-12">
                    <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-12 lg:mt-8 xl:text-right">البيانات
                        البنكية
                    </p>
                    <!--first div Dev -->
                    <div
                        class="mt-4 flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                        <div class="">
                            <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> اسم البنك
                            </label>
                            <div class="mt-1">
                                <input type="text" name="bank_name" placeholder=" الاسم"
                                    value={{ $user['bank_name'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم البنك
                            </label>
                            <div class="mt-1">
                                <input type="text" name="bank_branch" placeholder="الوظيفة"
                                    value={{ $user['bank_branch'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="email" class="block text-sm mr-4 text-[#349A37] font-FlatBold">رقم الحساب
                            </label>
                            <div class="mt-1">
                                <input type="text" name="account_number" placeholder=" الاسم"
                                    value={{ $user['account_number'] }}
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                    </div>
                </section>
                <!--third Section -->
                <section class="border-b-2 max-w-7xl border-[#9CA9B6] pb-12">
                    <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-12 lg:mt-8 xl:text-right">كلمة المرور
                    </p>
                    <!--first div Dev -->
                    <div
                        class="mt-4 flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                        <div class="">
                            <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> كلمة المرور
                                الحالية
                            </label>
                            <div class="mt-1">
                                <input type="text" name="password" placeholder="  كلمة المرور الحالية"
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> كلمة المرور
                                الجديدة
                            </label>
                            <div class="mt-1">
                                <input type="text" name="new_password" placeholder="كلمة المرور الجديدة"
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                        <div class="">
                            <label for="email" class="block text-sm mr-4 text-[#349A37] font-FlatBold">تأكيد كلمة
                                المرور
                                الجديدة
                            </label>
                            <div class="mt-1">
                                <input type="text" name="Confirm_password" placeholder=" تأكيد كلمة المرور"
                                    class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                            </div>
                        </div>
                    </div>
                </section>
                <button hidden id="button_form"
                    class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                    تعديل
                </button>
            </div>
        </form>
    </div>
@endsection
