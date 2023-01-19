@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false, 'left_SideBar' => false])
@section('content')
    @php
        $newDate = date('Y-m-d', strtotime($user['birth_date']));
        $StatWorknewDate = date('Y-m-d', strtotime($user['start_work_date']));
    @endphp
    <style>
        .selectdiv select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            /* Add some styling */
            background-image: none;
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">


        <div class="flex sm:flex-row flex-col sm:gap-y-0 gap-y-6 items-center justify-between mt-4 xl:mt-8">
            <div class="relative ">
                <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right"> لوحة التحكم</p>
                <div class="absolute border-b-[4px] pt-2 border-b-[#349A37]  w-28 hidden xl:block"></div>
            </div>
            <div class="flex ">
                <livewire:notification />
                <button onclick="location.href='/Admin'"
                    class=" Ctnbtn rounded-[50px] bg-transparent text-[#349A37] border-[1px] border-[#349A37]  text-base w-[204px] py-4 font-[700] hover:bg-[#349A37] hover:text-white duration-200">الذهاب
                    الى المنظومة</button>
            </div>

        </div>
        <!--Tabs -->
        <div class="mt-12 tabs-Number">
            <div class="block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <a href="#" target="_self" data-tab="tab-1"
                            class="activeTabs tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">التفاصيل
                            الشخصية</a>
                        <a href="#" target="_self" data-tab="tab-2"
                            class="tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">ساعات
                            العمل</a>
                        <a href="#" target="_self" data-tab="tab-3"
                            class="tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">ساعات
                            عمل الموظفين</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tabs-container">
            <!--Form -->
            <form method="POST" target="_self" action="{{ '/user/update' }}" enctype="multipart/form-data"
                class="tab tab-1 ProfileForm mt-8">
                @csrf
                <!--Perosonal Information -->
                <div class="flex flex-row items-center justify-between mt-8">
                    <p class="font-FlatBold text-xl sm:text-[22px] text-center mt-8 lg:mt-0 xl:text-right">البيانات الشخصية
                    </p>
                    <div class="flex flex-row items-center  gap-x-2 ">
                        <div class="relative">
                            <button type="submit"
                                class="connectUs duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px] text-left font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                حفظ
                            </button>
                            <svg class=" absolute top-5 right-4" width="17" height="17" viewBox="0 0 20 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    </div>
                </div>
                @php
                    $img = 'storage/' . $user['photo'];
                @endphp
                <div class="flex flex-row items-center justify-center">
                    <img src="/{{ $img }}" alt="" class="inline-block h-40 w-40 mt-6 rounded-full"
                        id="chosen" onclick=" document.getElementById('user_image_uploader').click();">
                    <input type="file" name="image" id="user_image_uploader" onchange="readURL('chosen', this);"
                        hidden />
                </div>
                <div class="mt-8">
                    <section class="border-b-2 max-w-7xl border-[#9CA9B6] pb-12">
                        <!--first div Dev -->
                        <div
                            class="flex flex-row items-start justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                            <div class="">
                                <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الاسم
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="name" placeholder=" الاسم" value="{{ $user['name'] }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="text-red-700 ">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="">
                                <label for="job" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الوظيفة
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="job" placeholder=" الوظيفة"
                                        value="{{ $user['job'] ? $user['job'] : '' }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                            <div class="">
                                <label for="email" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> البريد
                                    الالكتروني
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="email" placeholder=" الاسم" value="{{ $user['email'] }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-red-700 ">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="">
                                <label for="phone" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم الهاتف
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="phone" placeholder=" رقم التلفون"
                                        value="{{ $user['phone'] ? $user['phone'] : '' }}"
                                        class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <!--Second Dev -->
                        <div
                            class="mt-8 flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                            <div class="">
                                <label for="birth_date" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> تاريخ
                                    الميلاد
                                </label>
                                <div class="mt-1">
                                    <input type="date" value={{ $newDate }} name="birth_date"
                                        placeholder="الرجاء ادخال تاريخ الميلاد"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4 ">
                                </div>
                            </div>
                            <div class="">
                                <label for="id_number" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم الهوية
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="id_number" placeholder="الرجاء ادخال رقم الهوية"
                                        value="{{ $user['id_number'] ? $user['id_number'] : '' }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                            <div class="">
                                <label for="start_work_date" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> بدء
                                    العمل
                                    بالجمعية
                                </label>
                                <div class="mt-1">
                                    <input type="date" value={{ $StatWorknewDate }} name="start_work_date"
                                        placeholder="الرجاء ادخال تاريخ الميلاد" {{-- value="{{ $user['start_work_date'] ? $StatWorknewDate : '' }}" --}}
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4 text-right">
                                </div>
                            </div>
                            <div class="">
                                <label for="city" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> المدينة
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="city" placeholder="الرجاء ادخال المدينة"
                                        value="{{ $user['city'] ? $user['city'] : '' }}"
                                        class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                        </div>
                        <!--third Dev -->
                        <div
                            class="mt-8 flex flex-row items-center justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                            <div class="">
                                <label for="martial_status" class="block text-sm mr-4 text-[#349A37] font-FlatBold">
                                    الحالة
                                    الاجتماعية
                                </label>
                                <div class="mt-1 selectdiv">
                                    <select name="martial_status" id="martial_status"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border pr-4 rounded-[60px] sm:text-sm p-4">
                                        <option @if ($user['martial_status'] == null) selected @endif value="">الرجاء
                                            ادخال الحالة الاجتماعية</option>
                                        <option @if ($user['martial_status'] == '1') selected @endif value="1">
                                            {{ __('single') }}</option>
                                        <option @if ($user['martial_status'] == '2') selected @endif value="2">
                                            {{ __('married') }}</option>
                                        <option @if ($user['martial_status'] == '3') selected @endif value="3">
                                            {{ __('separated') }}</option>
                                        <option @if ($user['martial_status'] == '4') selected @endif value="4">
                                            {{ __('engaged') }}</option>
                                        <option @if ($user['martial_status'] == '5') selected @endif value="5">
                                            {{ __('divorced') }}</option>
                                        <option @if ($user['martial_status'] == '6') selected @endif value="6">
                                            {{ __('widower') }}</option>
                                    </select>
                                </div>
                            </div>
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
                                <label for="bank_name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> اسم البنك
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="bank_name" placeholder="الرجاء ادخال اسم البنك"
                                        value="{{ $user['bank_name'] ? $user['bank_name'] : '' }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                            <div class="">
                                <label for="bank_branch" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                    البنك
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="bank_number" placeholder="الرجاء ادخال رقم البنك"
                                        value="{{ $user['bank_number'] ? $user['bank_number'] : 'الرجاء ادخال رقم البنك' }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                            <div class="">
                                <label for="bank_branch" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                    الفرع
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="bank_branch" placeholder="الرجاء ادخال رقم الفرع"
                                        value="{{ $user['bank_branch'] ? $user['bank_branch'] : 'الرجاء ادخال رقم الفرع' }}"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                            <div class="">
                                <label for="account_number" class="block text-sm mr-4 text-[#349A37] font-FlatBold">رقم
                                    الحساب
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="account_number" placeholder="الرجاء ادخال رقم الحساب"
                                        value="{{ $user['account_number'] ? $user['account_number'] : '' }}"
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
                            class="mt-4 flex flex-row items-start justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                            <div class="">
                                <label for="password" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> كلمة المرور
                                    الحالية
                                </label>
                                <div class="mt-1">
                                    <input type="password" name="password" placeholder="كلمة المرور الحالية"
                                        autocomplete="off"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-red-700 ">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="">
                                <label for="new_password" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> كلمة
                                    المرور
                                    الجديدة
                                </label>
                                <div class="mt-1">
                                    <input type="password" name="new_password" placeholder="كلمة المرور الجديدة"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                            </div>
                            <div class="">
                                <label for="Confirm_password"
                                    class="block text-sm mr-4 text-[#349A37] font-FlatBold">تأكيد كلمة
                                    المرور
                                    الجديدة
                                </label>
                                <div class="mt-1 ">
                                    <input type="password" name="Confirm_password" placeholder=" تأكيد كلمة المرور"
                                        class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                </div>
                                @if ($errors->has('Confirm_password'))
                                    <span class="text-red-700 mr-4 pt-4">{{ $errors->first('Confirm_password') }}</span>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </form>
            <!--End Form -->
            <!--start Hourly work Time -->
            <div class="tab tab-2 ">
                <livewire:work-hours />
            </div>
            <!--End Hourly work Time -->
            <!--start Manger Hourly work Time -->
            <div class="tab tab-3 ">
                <livewire:admin-work-hours />
            </div>
            <!--End Manger Hourly work Time -->


        </div>
    </div>
    @php
    $firstName = '';

@endphp
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                @php

                    $firstName = $firstName . ' ' . $error . '<br>';

                @endphp
            @endforeach
            <script>
                var bool = {!! json_encode($firstName) !!};
                toastr.error(bool);
            </script>
            {{-- {!! $firstName !!} --}}
        </ul>
    </div>
@endif
@endsection

