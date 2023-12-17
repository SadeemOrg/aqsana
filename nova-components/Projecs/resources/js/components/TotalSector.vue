<template>
    <div class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-8 divide-y divide-gray-200">
            <div class="w-full">
                <BudgetInfo :budget="parseInt(Sector.Budget)" :divisor="1" label="ميزانية القطاع"
                    expensesLabel="مصاريف القطاع " :expensesValue="Sector.expenses_year" incomeLabel="مدخلات القطاع"
                    :incomeValue="Sector.income_year" net_amount_label="صافي انفاق القطاع" />
            </div>
            <!-- <div class="flex flex-row mt-10 items-center justify-between pb-8">
                <div class="flex flex-col items-start justify-start">
                    <ul>
                        <li>
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> ميزانية
                                    القطاع </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <h1 class="pt-2">{{ Sector.Budget }}₪</h1>
                                </div>
                            </div>
                        </li>
                        <li class="mt-10">
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700"> مصاريف
                                    القطاع </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                        <div style="width: 85%;" class="flex flex-row-reverse items-center justify-between">
                                            <h3 class="font-FlatBold">{{ Sector.expenses_year }}₪</h3>
                                            <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 : ((Sector.expenses_year /
                                                (Sector.Budget)) * 100).toFixed(2) + '%' }}</h3>
                                        </div>
                                        <progress dir="ltr" style="width: 90%;" :value="calculateProgress(Sector, 'Budget')"
                                            max="100"></progress>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mt-10">
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700"> مدخلات
                                    القطاع </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                        <div style="width: 85%;" class="flex flex-row-reverse items-center justify-between">
                                            <h3 class="font-FlatBold">{{ Sector.income_year }}₪</h3>
                                            <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 : ((Sector.income_year /
                                                (Sector.Budget)) * 100).toFixed(2) + '%' }}</h3>
                                        </div>
                                        <progress dir="ltr" style="width: 90%;" :value="calculateProgress(Sector, 'income')"
                                            max="100"></progress>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul>
                    <li class="">
                        <div class="flex flex-row items-center justify-start gap-x-2">
                            <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> صافي الانفاق
                                القطاع </h1>
                            <div class="budget_box flex flex-col items-center justify-center ">
                                <h1 class="pt-2">{{ (Sector.income_year - Sector.expenses_year).toFixed(2) }}₪</h1>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> -->
            <div>
                <div style="background-color: #eef1f4;" class="w-full py-4">
                    <div style="width: 95%;"
                        class="flex flex-row flex-wrap sm:flex-nowrap items-center justify-satrt my-4 mx-auto gap-x-2">
                        <div v-for="tab in sector_tabs" :key="tab.index"
                            class="flex flex-row items-center justify-center cursor-pointer w-1/4 mb-3">
                            <a v-on:click="toggleSectorTabs(tab.index)" v-bind:class="{
                                'text-green-600 bg-white w-full py-4 text-center rounded-md': openTab !== tab.index,
                                'text-white  bg-green-600 w-full py-4 text-center rounded-md': openTab === tab.index,
                            }">
                                {{ tab.name }}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- First quarter -->

                <div class="w-full" :class="{ hidden: openTab !== 1, flex: openTab === 1 }">
                    <BudgetInfo :budget="parseInt(Sector.Budget)" :divisor="4" label="ميزانية الربع الاول"
                        expensesLabel="مصاريف الربع الاول" :expensesValue="Sector.expenses_First"
                        incomeLabel="مدخلات الربع الاول" :incomeValue="Sector.income_First"
                        net_amount_label="صافي انفاق الربع الاول" />
                    <!-- <div class="flex flex-col items-start justify-start">
                        <ul>
                            <li>
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 245px;" for="street-address" class="block text-gray-700 "> ميزانية
                                        الربع الاول </h1>
                                    <div class="budget_box flex flex-col items-center justify-center gap-x-1 ">
                                        <h2 class="pt-2">{{ Sector.Budget / 4 }}₪</h2>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 245px;" for="street-address" class="block text-gray-700"> مصاريف
                                        الربع الأول </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.expenses_First }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 :
                                                    ((Sector.expenses_First /
                                                        (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'Budget_first_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 245px;" for="street-address" class="block text-gray-700"> مدخلات
                                        الربع الاول </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.income_First }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 : ((Sector.income_First
                                                    /
                                                    (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'income_first_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul>
                        <li class="">
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> صافي انفاق
                                    الربع الاول </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <h1 class="pt-2">{{ (Sector.income_First - Sector.expenses_First).toFixed(2) }}₪</h1>
                                </div>
                            </div>
                        </li>
                    </ul> -->
                </div>
                <!-- second quarter -->
                <div class="w-full" :class="{ hidden: openTab !== 2, flex: openTab === 2 }">
                    <BudgetInfo :budget="parseInt(Sector.Budget)" :divisor="4" label="ميزانية الربع الثاني"
                        expensesLabel="مصاريف الربع الثاني" :expensesValue="Sector.expenses_Second"
                        incomeLabel="مدخلات الربع الثاني" :incomeValue="Sector.income_Second"
                        net_amount_label="صافي انفاق الربع الثاني" />
                </div>
                <!-- <div class="flex flex-row mt-10 items-center justify-betwee pt-4"
                    :class="{ hidden: openTab !== 2, flex: openTab === 2 }">
                    <div class="flex flex-col items-start justify-start">
                        <ul>
                            <li>
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 245px;" for="street-address" class="block text-gray-700 "> ميزانية
                                        الربع الثاني </h1>
                                    <div class="budget_box flex flex-col items-center justify-center gap-x-1 ">
                                        <h2 class="pt-2">{{ Sector.Budget / 4 }}₪</h2>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 245px;" for="street-address" class="block text-gray-700"> مصاريف
                                        الربع الثاني </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.expenses_Second }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 :
                                                    ((Sector.expenses_Second /
                                                        (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'Budget_second_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 245px;" for="street-address" class="block text-gray-700"> مدخلات
                                        الربع الثاني </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.income_Second }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 : ((Sector.income_Second
                                                    /
                                                    (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'income_second_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul>
                        <li class="">
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> صافي انفاق
                                    الربع الثاني </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <h1 class="pt-2">{{ (Sector.income_Second - Sector.expenses_Second).toFixed(2) }}₪</h1>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> -->
                <!-- third quarter -->
                <div class="w-full" :class="{ hidden: openTab !== 3, flex: openTab === 3 }">
                    <BudgetInfo :budget="parseInt(Sector.Budget)" :divisor="4" label="ميزانية الربع الثالث"
                        expensesLabel="مصاريف الربع الثالث" :expensesValue="Sector.expenses_Third"
                        incomeLabel="مدخلات الربع الثالث" :incomeValue="Sector.income_Third"
                        net_amount_label="صافي انفاق الربع الثالث" />
                </div>
                <!-- <div class="flex flex-row mt-10 items-center justify-betwee pt-4"
                    :class="{ hidden: openTab !== 3, flex: openTab === 3 }">
                    <div class="flex flex-col items-start justify-start">
                        <ul>
                            <li>
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 255px;" for="street-address" class="block text-gray-700 "> ميزانية
                                        الربع الثالث </h1>
                                    <div class="budget_box flex flex-col items-center justify-center gap-x-1 ">
                                        <h2 class="pt-2">{{ Sector.Budget / 4 }}₪</h2>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 255px;" for="street-address" class="block text-gray-700"> مصاريف
                                        الربع الثالث </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.expenses_Third }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 :
                                                    ((Sector.expenses_Third /
                                                        (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'Budget_third_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 255px;" for="street-address" class="block text-gray-700"> مدخلات
                                        الربع الثالث </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.income_Third }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 : ((Sector.income_Third
                                                    /
                                                    (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'income_third_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul>
                        <li class="">
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> صافي انفاق
                                    الربع الثالث </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <h1 class="pt-2">{{ (Sector.income_Third - Sector.expenses_Third).toFixed(2) }}₪</h1>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> -->
                <!-- Fourth quarter -->
                <div class="w-full" :class="{ hidden: openTab !== 4, flex: openTab === 4 }">
                    <BudgetInfo :budget="parseInt(Sector.Budget)" :divisor="4" label="ميزانية الربع الرابع"
                        expensesLabel="مصاريف الربع الرابع" :expensesValue="Sector.expenses_fourth"
                        incomeLabel="مدخلات الربع الرابع" :incomeValue="Sector.income_fourth"
                        net_amount_label="صافي انفاق الربع الرابع" />
                </div>
                <!-- <div class="flex flex-row mt-10 items-center justify-betwee pt-4"
                    :class="{ hidden: openTab !== 4, flex: openTab === 4 }">
                    <div class="flex flex-col items-start justify-start">
                        <ul>
                            <li>
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 255px;" for="street-address" class="block text-gray-700 "> ميزانية
                                        الربع الرابع </h1>
                                    <div class="budget_box flex flex-col items-center justify-center gap-x-1 ">
                                        <h2 class="pt-2">{{ Sector.Budget / 4 }}₪</h2>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 255px;" for="street-address" class="block text-gray-700"> مصاريف
                                        الربع الرابع </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.expenses_fourth }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 :
                                                    ((Sector.expenses_fourth /
                                                        (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'Budget_fourth_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-10">
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    <h1 style="min-width: 255px;" for="street-address" class="block text-gray-700"> مدخلات
                                        الربع الرابع </h1>
                                    <div class="budget_box flex flex-col items-center justify-center ">
                                        <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                            <div style="width: 85%;"
                                                class="flex flex-row-reverse items-center justify-between">
                                                <h3 class="font-FlatBold">{{ Sector.income_fourth }}₪</h3>
                                                <h3 class="font-FlatBold">{{ Sector.Budget == 0 ? 0 : ((Sector.income_fourth
                                                    /
                                                    (Sector.Budget / 4)) * 100).toFixed(2) + '%' }}</h3>
                                            </div>
                                            <progress dir="ltr" style="width: 90%;"
                                                :value="calculateProgress(Sector, 'income_fourth_quarter')"
                                                max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul>
                        <li class="">
                            <div class="flex flex-row items-center justify-start gap-x-2">
                                <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> صافي انفاق
                                    الربع الرابع </h1>
                                <div class="budget_box flex flex-col items-center justify-center ">
                                    <h1 class="pt-2">{{ (Sector.income_fourth - Sector.expenses_fourth).toFixed(2) }}₪</h1>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
import BudgetInfo from './BudgetInfo.vue';

export default {
    props: ['Sector'],
    components: { BudgetInfo },
    data() {
        return {
            openTab: 1,
            sector_tabs: [
                { index: 1, name: 'الربع الاول' },
                { index: 2, name: 'الربع  الثاني' },
                { index: 3, name: 'الربع الثالث' },
                { index: 4, name: 'الربع الرابع' },
            ],
        }
    },
    methods: {
        toggleSectorTabs: function (tabNumber) {
            this.openTab = tabNumber;
        },
        calculateProgress(Sector, type) {
            switch (type) {
                case 'Budget':
                    return Sector.Budget === 0 ? 0 : (Sector.expenses_year / Sector.Budget) * 100;
                case 'income':
                    return Sector.Budget === 0 ? 0 : (Sector.income_year / Sector.Budget) * 100;
                case 'Budget_first_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.expenses_First / (Sector.Budget / 4)) * 100;
                case 'income_first_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.income_First / (Sector.Budget / 4)) * 100;
                case 'Budget_second_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.expenses_Second / (Sector.Budget / 4)) * 100;
                case 'income_second_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.income_Second / (Sector.Budget / 4)) * 100;
                case 'Budget_third_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.expenses_Third / (Sector.Budget / 4)) * 100;
                case 'income_third_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.income_Third / (Sector.Budget / 4)) * 100;
                case 'Budget_third_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.expenses_fourth / (Sector.Budget / 4)) * 100;
                case 'income_fourth_quarter':
                    return Sector.Budget === 0 ? 0 : (Sector.income_fourth / (Sector.Budget / 4)) * 100;
                default:
                    return 0;

            }
        },
    },
}
</script>

