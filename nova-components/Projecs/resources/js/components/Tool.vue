<template>
    <div>
        <div class="flex">
            <div class="w-full">
                <div class="w-full">
                    <div class="flex flex-row flex-wrap sm:flex-nowrap items-center justify-satrt w-full my-4 gap-x-2">
                        <div v-for="tab in tabs" :key="tab.index"
                            class="flex flex-row items-center justify-center cursor-pointer w-1/4 mb-3">
                            <a v-on:click="toggleTabs(tab.index)" v-bind:class="{
                                'text-green-600 bg-white w-full py-4 text-center rounded-md':
                                    openTab !== tab.index,
                                'text-white  bg-green-600 w-full py-4 text-center rounded-md':
                                    openTab === tab.index
                            }">
                                {{ tab.name }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">
                            <!-- first form -->
                            <div :class="{
                                hidden: openTab !== 1,
                                block: openTab === 1
                            }">
                                <Budgets :years="years" :year="year" />
                            </div>
                            <!-- second form -->
                            <div :class="{ hidden: openTab !== 2, block: openTab === 2 }">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-4">
                                    <div>
                                        <label
                                            class="block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0">
                                            السنة
                                        </label>
                                        <select
                                            class="appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                                            id="yearSelect" name="year" v-model="newyear">
                                            <option v-for="index in addYears.length" :key="index" :value="addYears[index]">
                                                {{ addYears[index] }}
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0">
                                            ميزانية السنة
                                        </label>
                                        <input v-on:input="onYearBudgetInput"
                                            class="appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                                            id="inline-full-name" type="text" v-model="budgetsOfyear" />
                                    </div>
                                </div>
                                <form @submit.prevent="savenew" class="add-form py-4">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-4">
                                        <div v-for="(Sector, index) in newSectors" :key="Sector.Sector"
                                            :value="Sector.Sector" class="mb-3">
                                            <div>
                                                <label
                                                    class="block text-gray-500 font-medium md:text-right mb-2 md:mb-0 text-sm w-64"
                                                    :for="index">
                                                    {{ Sector.Sector }}
                                                </label>
                                                <input v-on:input="onInput($event, index)"
                                                    class="appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                                                    :id="index" type="text" v-model="Sector.Budget" />
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="newSectors.length" class="md:flex md:items-center w-full justify-end">
                                        <div class="md:w-2/3">
                                            <button
                                                class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                                                type="submit">
                                                حفظ
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-right text-small" :class="{ 'text-danger': hasError }">
                                    Sum: {{ remainingCount }}
                                </p>
                            </div>
                        </div>
                        <!-- third form -->
                        <div :class="{
                            hidden: openTab !== 3,
                            block: openTab === 3
                        }">
                            <!-- ... (your form content) -->
                            <DeleteBudget :years="years" @get-years="getYears" />
                        </div>
                        <!-- fourth form -->
                        <div :class="{
                            hidden: openTab !== 4,
                            block: openTab === 4
                        }">
                            <!-- ... (your form content) -->
                            <div class="flex flex-col w-full">
                                <div class="py-4 w-3/6 bg-slate-700">
                                    <select @change="getSectorstatistics($event)" v-model="selectedItem"
                                        class="select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm">
                                        <option selected disabled value="0">
                                            الرجاء اختيار عام
                                        </option>
                                        <option class="" v-for="year in years" :key="year.year" :value="year.year">
                                            {{ year.year }}
                                        </option>
                                    </select>
                                </div>
                                <div v-if="isTotalSectorYearlyNotEmpty" class="w-full mb-12">
                                    <h1 class="my-5 mx-4 font-extrabold text-gray-700 text-3xl">
                                        الميزانية العامه لسنه {{ selectedyear }}
                                    </h1>
                                    <BudgetInfo :budget="parsedBudget" :divisor="1" label="مجمل الميزانية للعام "
                                        expensesLabel="مجمل المصاريف للعام " :expensesValue="totalSectorYearly.expenses_year
                                            " incomeLabel="مجمل المدخلات للعام" :incomeValue="totalSectorYearly.income_year
        " net_amount_label="صافي الربح والخساره " />
                                </div>
                                <div class="w-full">
                                    <div class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                                        <div class="-mb-px mr-2 last:mr-0 flex-auto text-center" v-for="(Sector,
                                            index) in budjetSector" :key="Sector.Sector" :value="Sector.Sector">
                                            <a class="text-xs font-bold uppercase px-5 py-4 my-2 shadow-lg rounded block leading-normal"
                                                v-on:click="
                                                    toggleTabsstatistic(index)
                                                    " v-bind:class="{
        'text-green-600 bg-white cursor-pointer':
            openTabstatistic !==
            index,
        'text-white bg-green-600 cursor-pointer':
            openTabstatistic ===
            index
    }">
                                                {{ Sector.Sector }}
                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                                        <div v-if="budjetSector.length > 0" class="px-4 py-5 flex-auto">
                                            <div class="tab-content tab-space">
                                                <div v-for="(Sector,
                                                    index) in budjetSector" :key="Sector.Sector" :value="Sector.Sector"
                                                    v-bind:class="{
                                                        hidden:
                                                            openTabstatistic !==
                                                            index,
                                                        block:
                                                            openTabstatistic ===
                                                            index
                                                    }">
                                                    <h1 class="my-5 mx-4 font-extrabold text-gray-700 text-3xl">
                                                        {{ Sector.Sector }}
                                                    </h1>
                                                    <TotalSector :Sector="Sector" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PureVueChart from "pure-vue-chart";
import TotalSector from "./TotalSector.vue";
import Budgets from "./Budgets.vue";
import CreateBudget from "./CreateBudget.vue";
import DeleteBudget from "./DeleteBudget.vue";
import BudgetInfo from "./BudgetInfo.vue";

export default {
    components: {
        PureVueChart,
        TotalSector,
        Budgets,
        CreateBudget,
        DeleteBudget,
        BudgetInfo
    },
    data() {
        return {
            openTab: 1,
            openTabstatistic: 0,
            selectedItem: "0",
            selectedyear: 0,
            year: "0",
            years: [],
            addYears: [],
            Sectors: [],
            newSectors: [],
            budjetSector: [],
            totalSectorYearly: {
                expenses_year: null,
                income_year: null
            },
            deletSectors: [],
            hasError: false,
            budgetsOfyear: 0,
            newyear: null,

            points: [1, 4, 5, 3, 60, 4, 5, 3, 60, 4, 5],
            tabs: [
                { index: 1, name: "الميزانيات" },
                { index: 2, name: "اضافة جديد" },
                { index: 3, name: "حذف" },
                { index: 4, name: "احصائيات" }
            ],
            projectshow: false,
            chartWidth: 400,
            remainingCount: 0,
            // includedYears: []
        };
    },
    beforeMount() {
        this.getYears();
        this.getSector();
    },
    mounted() {
        const startYear = 2022;
        const endYear = 2050;

        for (let year = startYear; year <= endYear; year++) {
            this.addYears.push(year);
        }
        window.addEventListener("resize", () => {
            if (window.innerWidth < 1220 && window.innerWidth > 500) {
                this.chartWidth = 300;
            } else if (window.innerWidth < 499) {
                this.chartWidth = 250;
            }
        });
    },
    methods: {
        countdown: function () {
            this.remainingCount = 0;
            let sumBud = 0;
            this.newSectors.forEach(element => {
                if (element["Budget"]) {
                    sumBud += parseInt(element["Budget"]);
                }
            });
            this.remainingCount = this.budgetsOfyear - sumBud;
            this.hasError = this.budgetsOfyear < sumBud;
        },
        toggleTabs: function (tabNumber) {
            this.openTab = tabNumber;
        },
        toggleTabsstatistic: function (tabNumber) {
            this.openTabstatistic = tabNumber;
        },
        getYears: async function () {
            try {
                const response = await axios.post("/year");
                this.years = response.data;
                // this.includedYears = Object.values(this.years).map(
                //     item => parseInt(item.year)
                // );
                // const startYear = 2022;
                // const endYear = 2050;
                // for (let year = startYear; year <= endYear; year++) {
                //     if (!this.includedYears.includes(year)) {
                //         this.addYears.push(year);
                //     }
                // }
            } catch (error) {
                console.error(error);
            }
        },
        async getSector() {
            try {
                const response = await axios.post("/Sectors");
                this.newSectors = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async getSectorstatistics(event) {
            this.selectedyear = event.target.value;
            try {
                const [
                    totalSectorResponse,
                    budjetSectorResponse
                ] = await Promise.all([
                    axios.post("/total-sector-budget", {
                        year: event.target.value
                    }),
                    axios.post("/Sectorstatistics", {
                        year: event.target.value
                    })
                ]);

                // Handle the responses
                this.totalSectorYearly = totalSectorResponse.data;
                this.budjetSector = budjetSectorResponse.data;
            } catch (error) {
                console.error("Error making POST request:", error);
            }
        },
        sum() {
            let sum = 0;
            return this.newSectors.forEach(element => {
                sum += parseInt(element["Budget"]);
            });
            return sum;
        },
        convertArabicToEnglish(input) {
            const arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

            return input.split('').map(char => {
                const index = arabicNumbers.indexOf(char);
                return index > -1 ? englishNumbers[index] : char;
            }).join('');
        },
        onInput(event, index) {
            const value = this.convertArabicToEnglish(event.target.value);
            this.newSectors[index].Budget = value;
            this.countdown();
        },
        onYearBudgetInput(event) {
            this.budgetsOfyear = this.convertArabicToEnglish(event.target.value);
            this.countdown();
        },
        async savenew() {
            let sum = 0;
            this.newSectors.forEach(element => {
                sum += parseInt(element["Budget"]);
            });
            if (this.budgetsOfyear >= sum) {
                try {
                    const response = await axios.post("/save", {
                        year: this.newyear,
                        budgetsOfyear: this.budgetsOfyear,
                        Sectors: this.newSectors
                    });
                    toastr.options = {
                        closeButton: true,
                        debug: false,
                        positionClass: "toast-bottom-right",
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "2000",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    };
                    toastr.success("تم انشاء ميزانية السنة بنجاح");
                    this.getYears();
                } catch (error) {
                    toastr.options = {
                        closeButton: true,
                        debug: false,
                        positionClass: "toast-bottom-right",
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "2000",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    };
                    toastr.error("حدث خطأ أثناء الحفظ");
                    console.error(error);
                }
            } else {
                toastr.options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "2000",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                };

                toastr.error("ميزانية السنة لا تطابق ميزانية القطاعات");
            }
        }
    },
    computed: {
        isTotalSectorYearlyNotEmpty() {
            return Object.keys(this.totalSectorYearly).length > 0;
        },
        parsedBudget() {
            const parsedValue = parseInt(this.totalSectorYearly.Budgets);
            return isNaN(parsedValue) ? 0 : parsedValue;
        }
    }
};
</script>
