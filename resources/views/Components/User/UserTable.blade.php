<div class="px-4 sm:px-6 lg:px-8 mt-8">
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            @if ($tab != 2)
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-right text-sm font-semibold text-[#349A37] ">
                                    اسم الموظف</th>
                            @endif
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-right text-sm font-semibold text-[#349A37] ">
                                اليوم</th>
                            <th scope="col" class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">
                                التاريخ
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">ساعة
                                البدء
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37]">ساعة
                                الانتهاء</th>
                            <th scope="col"
                                class="py-3.5 px-3 text-right text-sm font-semibold text-[#349A37] min-w-[150px]">عدد
                                ساعات العمل</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            @if ($tab != 2)
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                    زياد سلمان</td>
                            @endif
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                السبت</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">12-12-2022</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                12:20:00 مساءا</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">5:00:00 مساءا</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">5 ساعات</td>
                        </tr>

                        <!-- More people... -->
                        <tr>
                            @if ($tab != 2)
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                    زياد سلمان</td>
                            @endif
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                السبت</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">12-12-2022</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                12:20:00 مساءا</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">5:00:00 مساءا</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">5 ساعات</td>
                        </tr>
                        <!-- More people... -->
                        <tr>
                            @if ($tab != 2)
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                    زياد سلمان</td>
                            @endif
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-right font-medium text-[#101426] ">
                                السبت</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">12-12-2022</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">
                                12:20:00 مساءا</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426]">5:00:00 مساءا</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-[#101426] min-w-[150px]">5 ساعات</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
