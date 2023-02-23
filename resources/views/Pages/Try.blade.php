@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false, 'left_SideBar' => false])
@section('content')
    <!-- component -->
    @php
        // dd("dd");
        $newDate = date('Y-m-d', strtotime($user['birth_date']));
        $StatWorknewDate = date('Y-m-d', strtotime($user['start_work_date']));
    @endphp
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <!-- page -->
    <main class="min-h-screen w-full bg-gray-100 text-gray-700 " x-data="layout">
        <!-- header page -->
        <header class="flex w-full items-center justify-between border-b-2 border-gray-200 bg-white p-2">
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <button type="button" class="text-3xl" @click="asideOpen = !asideOpen"><i class="bx bx-menu"></i></button>
                {{-- <p>ss</p> --}}
            </div>
        </header>
        <div class="flex">
            <!-- aside -->
            <nav class=" TabsSidee sm:flex w-72 flex-col space-y-2 border-r-2 border-gray-200 bg-white p-2 "
                aria-label="Tabs" style="height: 115vh" x-show="asideOpen">
                <a href="#" target="_self"
                    class=" tabsAlphaA flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span class="text-2xl"><i class="bx bx-home"></i></span>
                    <span>البيانات الشخصية</span>
                </a>
                <a href="#" target="_self"
                    class="tabsAlphaB flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span class="text-2xl"><i class="bx bx-cart"></i></span>
                    <span>ساعات عملي</span>
                </a>
                <a href="#" target="_self"
                    class="tabsAlphaC flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span class="text-2xl"><i class="bx bx-shopping-bag"></i></span>
                    <span>ساعات عمل الموظفين</span>
                </a>
            </nav>
         
            <!-- main content page -->
            {{-- <nav class="sm:hidden absolute flex flex-col items-start justify-start" x-show="asideOpen">
                <a href="#" target="_self"
                    class=" tabsAlphaA flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span>البيانات الشخصية</span>
                </a>
                <a href="#" target="_self"
                    class="tabsAlphaB flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span>ساعات عملي</span>
                </a>
                <a href="#" target="_self"
                    class="tabsAlphaC flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-[#349A37] hover:text-black">
                    <span>ساعات عمل الموظفين</span>
                </a>
            </nav> --}}
            <div class="tabs-Side-container w-full">
                <div class="container tab tab-A px-8 mx-auto mt-8 max-w-6xl">
                    <div class="flex sm:flex-row flex-col sm:gap-y-0 gap-y-6 items-center justify-between mt-4 xl:mt-8">
                        <div class="relative ">
                            <p itemprop="name" class="font-FlatBold text-3xl text-center xl:text-right"> لوحة التحكم</p>
                            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37]  w-28 hidden xl:block"></div>
                        </div>
                        <div class="flex ">
                            {{-- <livewire:notification /> --}}
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
                                        class="activeTabs tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">
                                        البيانات الشخصية</a>
                                    <a href="#" target="_self" data-tab="tab-2"
                                        class="tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">البيانات
                                        البنكية </a>
                                    <a href="#" target="_self" data-tab="tab-3"
                                        class="tabs border-transparent text-[#101426] hover:text-[#349A37] hover:border-[1px] hover:border-b-[#349A37] w-1/2 sm:w-1/3 py-4 px-1 text-center sm:text-right border-b-2 font-FlatBold text-sm sm:text-[16px]">
                                        كلمة المرور</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-container">
                        <!--Form -->
                        <form method="POST" target="_self" action="{{ '/user/update' }}" enctype="multipart/form-data"
                            class="tab tab-1  my-6 mt-8">
                            @csrf
                            <!--Perosonal Information -->
                            <div
                                class="  flex flex-row items-center justify-center sm:justify-between gap-x-4 sm:gap-x-0 mt-8 sm:flex-nowrap flex-wrap">
                                <p class="font-FlatBold text-xl sm:text-[22px] text-center lg:mt-8  xl:text-right">البيانات
                                    الشخصية
                                </p>
                                <div class="flex flex-row items-center gap-x-2 ">
                                    <div class="w-[150px] flex items-center justify-center">
                                        <button type="submit"
                                            class="connectUs w-full text-center duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @php
                                $img =
                                    'data:image/png;base64,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';
                            @endphp
                            <div class="flex flex-row items-center justify-center mb-12">
                                <img src="/{{ $img }}" alt=""
                                    class="inline-block h-40 w-40 mt-6 rounded-full" id="chosen"
                                    onclick=" document.getElementById('user_image_uploader').click();">
                                <input type="file" name="image" id="user_image_uploader"
                                    onchange="readURL('chosen', this);" hidden />
                            </div>
                            <div
                                class="flex flex-row items-start justify-center lg:justify-start  flex-wrap gap-y-4 gap-x-6">
                                <div class="">
                                    <label for="name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> الاسم
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="name" placeholder=" الاسم"
                                            value="{{ $user['name'] }}"
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
                                        <input type="text" name="email" placeholder=" الاسم"
                                            value="{{ $user['email'] }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-red-700 ">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <label for="phone" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                        الهاتف
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

                                <div class="">
                                    <label for="birth_date" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> تاريخ
                                        الميلاد
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" value={{ $newDate }} name="birth_date"
                                            placeholder="الرجاء ادخال تاريخ الميلاد"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4 ">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="id_number" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> رقم
                                        الهوية
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="id_number" placeholder="الرجاء ادخال رقم الهوية"
                                            value="{{ $user['id_number'] ? $user['id_number'] : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="start_work_date" class="block text-sm mr-4 text-[#349A37] font-FlatBold">
                                        بدء
                                        العمل
                                        بالجمعية
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" {{-- value={{ $StatWorknewDate }}  --}} name="start_work_date"
                                            placeholder="الرجاء ادخال تاريخ الميلاد"
                                            value="{{ $user['start_work_date'] ? $StatWorknewDate : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4 text-right">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="city" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> البلد
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="city" placeholder="الرجاء ادخال المدينة"
                                            value="{{ $user['city'] ? $user['city'] : '' }}"
                                            class="block md:min-w-[300px] w-full  border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
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
                        </form>
                        <!--Second Form -->
                        <form class="tab tab-2 my-6 ">
                            <div
                                class="  flex flex-row items-center justify-center sm:justify-between gap-x-4 sm:gap-x-0 mt-8  flex-wrap">
                                <p class="font-FlatBold text-xl sm:text-[22px] text-center lg:mt-8  xl:text-right">البيانات
                                    البنكية
                                </p>
                                <div class="flex flex-row items-center gap-x-2 ">
                                    <div class="w-[150px] flex items-center justify-center">
                                        <button type="submit"
                                            class="connectUs w-full text-center duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-8 flex flex-row items-center justify-center lg:justify-start  flex-wrap gap-y-4 gap-x-6">
                                <div class="">
                                    <label for="bank_name" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> اسم
                                        البنك
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
                                    <label for="account_number"
                                        class="block text-sm mr-4 text-[#349A37] font-FlatBold">رقم
                                        الحساب
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="account_number" placeholder="الرجاء ادخال رقم الحساب"
                                            value="{{ $user['account_number'] ? $user['account_number'] : '' }}"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--Last Form -->
                        <form class="tab tab-3 my-6 ">
                            <div
                                class="  flex flex-row items-center justify-center sm:justify-between gap-x-4 sm:gap-x-0 my-8  flex-wrap">
                                <p class="font-FlatBold text-xl sm:text-[22px] text-center xl:text-right">كلمة
                                    المرور
                                </p>
                                <div class="flex flex-row items-center gap-x-2 ">
                                    <div class="w-[150px] flex items-center justify-center">
                                        <button type="submit"
                                            class="connectUs w-full text-center duration-200  px-5 lg:px-10 py-3 mt-2 text-[13px]  font-FlatBold rounded-[30px] text-white bg-[#4F37FD] hover:bg-[#101426] hover:text-white ">
                                            حفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-4 flex flex-row items-start justify-center lg:justify-start xl:flex-nowrap flex-wrap gap-y-4 gap-x-6">
                                <div class="">
                                    <label for="password" class="block text-sm mr-4 text-[#349A37] font-FlatBold"> كلمة
                                        المرور
                                        الحالية
                                    </label>

                                    <div class="mt-1">
                                        <input type="password" id="myInput" name="password"
                                            placeholder="كلمة المرور الحالية" autocomplete="off" value="10203040"
                                            class="block md:min-w-[300px] w-full border-[#8F9BB3] border rounded-[60px] sm:text-sm p-4">
                                        <div class=" flex fle-row items-center justify-start gap-x-1 mt-2 mr-3">
                                            <input type="checkbox" onclick="myFunction()">
                                            <p>Show Password</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-red-700 ">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    <label for="new_password" class="block text-sm mr-4 text-[#349A37] font-FlatBold">
                                        كلمة
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
                                        <span
                                            class="text-red-700 mr-4 pt-4">{{ $errors->first('Confirm_password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container tab tab-B px-8 mx-auto mt-8 max-w-6xl hidden">
                    <livewire:work-hours />
                </div>
                <div class="container tab tab-C px-8 mx-auto mt-8 max-w-6xl hidden">
                    <livewire:admin-work-hours />
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("layout", () => ({
                profileOpen: false,
                asideOpen: true,
            }));
        });
    </script>
@endsection
