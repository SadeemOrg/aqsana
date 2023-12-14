<template>
    <div class="flex flex-row mt-10 items-center justify-betwee pt-4">
        <div class="flex flex-col items-start justify-start">
            <ul>
                <li>
                    <div class="flex flex-row items-center justify-start gap-x-2">
                        <h1 style="min-width: 245px;" for="street-address"  class="block text-gray-700 ">{{
                            label }} </h1>
                        <div class="budget_box flex flex-col items-center justify-center gap-x-1 ">
                            <h2 class="pt-2">{{ budget/divisor }}₪</h2>
                        </div>
                    </div>
                </li>
                <li class="mt-10">
                    <div class="flex flex-row items-center justify-start gap-x-2">
                        <h1 style="min-width: 245px;"  class="block text-gray-700"> {{
                            expensesLabel }}</h1>
                        <div class="budget_box flex flex-col items-center justify-center ">
                            <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                <div style="width: 85%;" class="flex flex-row-reverse items-center justify-between">
                                    <h3 class="font-FlatBold">{{ expensesValue }}₪</h3>
                                    <h3 class="font-FlatBold">{{ budget == 0 ? 0 : ((expensesValue / (budget / divisor)) *
                                        100).toFixed(2) + '%' }}</h3>
                                </div>
                                <progress dir="ltr" style="width: 90%;" :value="calculateProgress('expenses')"
                                    max="100"></progress>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="mt-10">
                    <div class="flex flex-row items-center justify-start gap-x-2">
                        <h1 style="min-width: 245px;"  class="block text-gray-700"> {{
                            incomeLabel }} </h1>
                        <div class="budget_box flex flex-col items-center justify-center ">
                            <div class="flex flex-col items-center justify-center" style="width: 100%;">
                                <div style="width: 85%;" class="flex flex-row-reverse items-center justify-between">
                                    <h3 class="font-FlatBold">{{ incomeValue }}₪</h3>
                                    <h3 class="font-FlatBold">{{ budget == 0 ? 0 : ((incomeValue / (budget / divisor)) *
                                        100).toFixed(2) + '%' }}</h3>
                                </div>
                                <progress dir="ltr" style="width: 90%;" :value="calculateProgress('income')"
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
                    <h1 style="min-width: 210px;" for="street-address" class="block text-gray-700 "> {{ net_amount_label }} </h1>
                    <div class="budget_box flex flex-col items-center justify-center ">
                        <h1 class="pt-2">{{ (incomeValue - expensesValue).toFixed(2) }}₪</h1>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        budget: Number,
        divisor: Number,
        label: String,
        expensesLabel: String,
        // value: Number,
        expensesValue: Number,
        incomeValue: Number,
        incomeLabel: String,
        net_amount_label: String,


    },
    computed: {
        // labelId() {
        //     return `label-${this._uid}`;
        // },
        // expensesId() {
        //     return `expenses-${this._uid}`;
        // },
        // incomesId() {
        //     return `incomes-${this._uid}`;
        // },
    },
    methods: {
        calculateProgress(type) {
            switch (type) {
                case 'expenses':
                    return this.budget == 0 ? 0 : (this.expensesValue / (this.budget / this.divisor)) * 100;
                case 'income':
                    return this.budget == 0 ? 0 : (this.incomeValue / (this.budget / this.divisor)) * 100;
                default:
                    return 0;
            }
        },
    },
};
</script>

<style scoped>
progress {
    width: 95%;
    /* Adjust the width as needed */
    height: 10px;
    appearance: none;
    border-radius: 5px;
    background: #ddd;
}

progress::-webkit-progress-value {
    background-color: #34ca96;
    /* Adjust to match the overall border-radius */
    border-radius: 5px;
}

progress::-webkit-progress-bar {
    background-color: #ddd;
    border-radius: 5px;
}

.budget_box {
    min-width: 250px;
    min-height: 70px;
    border: 2px solid;
    border-radius: 10px;
    border-color: #dfe1e0;
    z-index: 10;
    background-color: #F2E9AE;

}
</style>


