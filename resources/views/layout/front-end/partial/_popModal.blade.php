@php

    $Imagemobile = 'storage/' . nova_get_setting('image_mobile_pop_up', 'default_value');
    $Imageweb = 'storage/' . nova_get_setting('image_web_pop_up', 'default_value');
    $link = nova_get_setting('link_pop_up', 'default_value');
    $text = nova_get_setting('text_pop_up', 'تبرع الان');



@endphp
<!-- Start Pop up Modal-->
<div dir="rtl" class="CloseHomePopUp relative hiddenModal  z-10" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed z-100 inset-0 sm:top-14 overflow-y-auto ">
        <div
            class="flex items-start sm:items-center justify-center max-w mt-20 sm:mt-4 xl:mt-0 min-h-full p-4 sm:p-0 text-right">
            <div
                class="relative ModalContainer bg-white rounded-lg px-4 pt-5 pb-4  shadow-xl transform transition-all sm:my-8 overflow-y-visible sm:p-6">
                <div class="flex flex-row items-center justify-end pb-4">

                </div>
                <div class="flex flex-col items-center justify-center my-3 gap-y-3">
                    <div class="flex text-center justify-end gap-y-6">
                        <a target="_self"
                            class="bg-[#349A37] hover:bg-[#101426] duration-200 py-4 ml-2 text-white text-2xl rounded-[50px] w-[160px] lg:w-[180px] xl:w-[220px] "
                            href="{{ $link }}">{{ $text }}</a>
                            <button type="button"
                            class=" PopUp_Modal_Home_Close  bg-[#349A37] hover:bg-[#101426] duration-200 py-4 ml-2 text-white text-2xl rounded-[50px] w-[160px] lg:w-[180px] xl:w-[220px] ">
                            <span class="sr-only">Close</span>
                            <!-- Heroicon name: outline/x -->
                            اكمل تصفح الموقع
                        </button>

                    </div>
                    <img class="h-[1000px] hidden sm:flex "
                        src="/{{  $Imageweb }}" />
                    <img class=" sm:hidden flex " src="/{{  $Imagemobile }}" />

                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- endPop up Modal-->
