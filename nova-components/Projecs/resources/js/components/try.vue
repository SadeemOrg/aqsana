<template>
    <div class="mt-6 grid grid-cols-2 gap-y-6 gap-x-4 sm:grid-cols-8">
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">ميزانبة القطاع </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.Budget"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                مصاريف القطاع </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.expenses_year + ':::' + ((Sector.expenses_year / (Sector.Budget)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                مدخلات القطاع</label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.income_year + ':::' + ((Sector.income_year / (Sector.Budget)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                صافي الانفاق القطاع
            </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="(Sector.income_year - Sector.expenses_year).toFixed(2)"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        {/* <!--First Quarter --> */}
        <div class="sm:col-span-2">
            <label for="city" class="block text-sm font-medium text-gray-700">الربع الاول ميزانية </label>
            <div class="mt-1">
                <input readonly type="text" name="city" id="city" autocomplete="address-level2" :value="Sector.Budget / 4"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="region" class="block text-sm font-medium text-gray-700">الربع الاول مصاريف</label>
            <div class="mt-1">
                <input readonly type="text" name="region" id="region" autocomplete="address-level1"
                    :value="Sector.expenses_First + ':::' + ((Sector.expenses_First / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                مدخلات الربع الاول
            </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.income_First + ':::' + ((Sector.income_First / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="postal-code" class="block text-sm font-medium text-gray-700">الربع الاول صافي الانفاق</label>
            <div class="mt-1">
                <input readonly type="text" name="postal-code" id="postal-code" autocomplete="postal-code" :value="(Sector.income_First - Sector.expenses_First).toFixed(2)
                    "
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <!--Second Quarter -->
        <div class="sm:col-span-2">
            <label for="city" class="block text-sm font-medium text-gray-700">الربع الثاني ميزانية
            </label>
            <div class="mt-1">
                <input readonly type="text" name="city" id="city" autocomplete="address-level2" :value="Sector.Budget / 4"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="region" class="block text-sm font-medium text-gray-700">الربع الثاني مصاريف
            </label>
            <div class="mt-1">
                <input readonly type="text" name="region" id="region" autocomplete="address-level1"
                    :value="Sector.expenses_Second + ':::' + ((Sector.expenses_Second / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                مدخلات الربع الثاني
            </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.income_Second + ':::' + ((Sector.income_Second / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="postal-code" class="block text-sm font-medium text-gray-700">الربع الثاني صافي الانفاق
            </label>
            <div class="mt-1">
                <input readonly type="text" name="postal-code" id="postal-code" autocomplete="postal-code" :value="(Sector.income_Second -
                        Sector.expenses_Second).toFixed(2)
                    "
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <!--Third quarter  -->
        <div class="sm:col-span-2">
            <label for="city" class="block text-sm font-medium text-gray-700">الربع الثالت ميزانية
            </label>
            <div class="mt-1">
                <input readonly type="text" name="city" id="city" autocomplete="address-level2" :value="Sector.Budget / 4"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="region" class="block text-sm font-medium text-gray-700">الربع الثالت مصاريف
            </label>
            <div class="mt-1">
                <input readonly type="text" name="region" id="region" autocomplete="address-level1"
                    :value="Sector.expenses_Third + ':::' + ((Sector.expenses_Third / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                مدخلات الربع الثالت
            </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.income_Third + ':::' + ((Sector.income_Third / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="postal-code" class="block text-sm font-medium text-gray-700">الربع الثالت صافي الانفاق
            </label>
            <div class="mt-1">
                <input readonly type="text" name="postal-code" id="postal-code" autocomplete="postal-code" :value="(Sector.income_Third -
                        Sector.expenses_Third).toFixed(2)
                    "
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <!-- The fourth quarter  -->
        <div class="sm:col-span-2">
            <label for="city" class="block text-sm font-medium text-gray-700">الربع الرابع ميزانية
            </label>
            <div class="mt-1">
                <input readonly type="text" name="city" id="city" autocomplete="address-level2" :value="Sector.Budget / 4"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="region" class="block text-sm font-medium text-gray-700">الربع الرابع مصاريف
            </label>
            <div class="mt-1">
                <input readonly type="text" name="region" id="region" autocomplete="address-level1"
                    :value="Sector.expenses_fourth + ':::' + ((Sector.expenses_fourth / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="street-address" class="block text-sm font-medium text-gray-700">
                مدخلات الربع الرابع
            </label>
            <div class="mt-1">
                <input readonly type="text" name="street-address" id="street-address" autocomplete="street-address"
                    :value="Sector.income_fourth + ':::' + ((Sector.income_fourth / (Sector.Budget / 4)) * 100).toFixed(2) + '%'"
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="postal-code" class="block text-sm font-medium text-gray-700">الربع الرابع صافي الانفاق
            </label>
            <div class="mt-1">
                <input readonly type="text" name="postal-code" id="postal-code" autocomplete="postal-code" :value="+Sector.income_First -
                    Sector.expenses_fourth
                    "
                    class="p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div>
    </div>
</template>
