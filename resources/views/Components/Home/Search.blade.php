<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 ">
    <div
        class="absolute z-10 mt-10 -top-48 w-[75%] bg-white rounded-[5px] h-20 flex flex-row justify-start items-center">
        <!--search Bar -->
        <div dir="rtl" class=" relative shadow-sm  w-full bg-white border-0 h-full  rounded-md">
            <form class="h-full" action="{{ route('pagesearch') }}" method="get">
                <div class="absolute inset-y-0 right-10 pl-3 flex items-center pointer-events-none">
                    <!-- Heroicon name: solid/mail -->
                    <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M29.0416 27.3252L21.9016 19.8992C23.7374 17.7169 24.7433 14.971 24.7433 12.1125C24.7433 5.43377 19.3095 0 12.6308 0C5.95208 0 0.518311 5.43377 0.518311 12.1125C0.518311 18.7912 5.95208 24.225 12.6308 24.225C15.1381 24.225 17.5274 23.4687 19.5702 22.0331L26.7645 29.5155C27.0652 29.8278 27.4697 30 27.9031 30C28.3133 30 28.7025 29.8436 28.9979 29.5592C29.6257 28.9552 29.6457 27.9535 29.0416 27.3252ZM12.6308 3.15978C17.5674 3.15978 21.5835 7.17586 21.5835 12.1125C21.5835 17.0491 17.5674 21.0652 12.6308 21.0652C7.69417 21.0652 3.67809 17.0491 3.67809 12.1125C3.67809 7.17586 7.69417 3.15978 12.6308 3.15978Z"
                            fill="#349A37" />
                    </svg>
                </div>
                <input type="search" name="search" id="search"
                    class="search-bar px-20 shadow-sm  block w-full bg-white border-0 h-full sm:text-sm rounded-md focus:ring-[#349A37] focus:border-[#349A37]"
                    placeholder="ابحث عن مشروع , خبر , تبرع ... ">

                <div class="absolute inset-y-0 left-6 flex items-center ">
                    <!-- Heroicon name: solid/mail -->
                    <button type="submit"
                        class="inline-flex items-center px-8 py-2 text-sm font-medium rounded-3xl text-white bg-[#349A37] hover:bg-[#101426] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-transparent">بحث
                    </button>
                </div>
                <div
                    class="card absolute bg-green-50 search-card z-10 my-2 h-40 overflow-auto w-[65%] top-[100%] right-0 rounded shadow hidden">
                    <div class="card-body p-6 text-right search-result-box" style="">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
