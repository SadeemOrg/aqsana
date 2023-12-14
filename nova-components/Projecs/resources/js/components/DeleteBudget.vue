<template>
    <div>
    <div class="py-4 w-[95%] bg-slate-700">
        <select
            class="select1 mt-1 block w-full rounded-md border-2 border-gray-200 px-4 py-2 pl-3 pr-10 text-base focus:border-black focus:outline-none focus:ring-black sm:text-sm"
            @change="onChangedelet($event)" selectedyear>
            <option selected disabled value="0">
                الرجاء اختيار عام
            </option>

            <option v-for="year in years" :key="year.year" :value="year.year">
                {{ year.year }}
            </option>
        </select>
    </div>
    <form @submit.prevent="onSubmit" class="add-form py-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

            <div v-for="Sector in deletSectors" :key="Sector.Sector" :value="Sector.Sector" class="mb-3">

                <div>
                    <label class="block text-gray-500 font-medium md:text-right mb-2 md:mb-0 text-sm w-64"
                        for="inline-full-name">
                        {{ Sector.Sector }}
                    </label>
                    <input
                        class=" appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                        id="inline-full-name" type="text" v-model="Sector.Budget" />
                </div>
            </div>
        </div>
        <div v-if="deletSectors.length" class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div v-if="deletSectors.length" class="md:flex md:items-center w-full justify-end">
                <div class="md:w-2/3">
                    <button
                        class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                        type="submit" @click="deleteSector()">
                        حذف
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</template>

<script>
export default {
    props: ['years'],
    data() {
        return {
            selectedItem: "0",
            selectedyear: "0",
            year: "0",
            deletSectors: [],
        };
    },
    methods: {
        onChangedelet(event) {
            axios
                .post("/SectorsBudget", {
                    year: event.target.value,
                })
                .then((response) => {
                    this.deletSectors = response.data;
                    this.selectedItem = "0";
                    this.selectedyear = "0";
                    this.year = event.target.value;
                });
        },
        deleteSector() {
            axios.post("/delet", {
                year: this.year,
            });
            this.deletSectors = [];
            this.getYears();
        },

    },
}
</script>

