<template>
    <div>
        <div class="py-4 bg-slate-700">
            <div class="flex flex-col items-start justify-start" style="width: 80%;">
                <label class="block text-black text-base ml-4 py-2 font-medium md:text-right mb-1 md:mb-0">
                    اختر السنة التي تريد حذفها
                </label>
                <select
                class="select1 mt-1 w-full block rounded-md border-2 border-gray-200 px-4 py-2 pl-3 pr-10 text-base focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                @change="onChangedelet($event)" v-model="selectedYear">
                <option selected disabled value="0">
                    الرجاء اختيار عام
                </option>
                <option v-for="year in localYears" :key="year.year" :value="year.year">
                    {{ year.year }}
                </option>
            </select>
        </div>
        </div>
        <form @submit.prevent="deleteSector" class="add-form py-4">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="Sector in deletSectors" :key="Sector.Sector" :value="Sector.Sector" class="mb-3">
                    <div>
                        <label class="block text-gray-500 font-medium md:text-right mb-2 md:mb-0 text-sm w-64"
                            for="inline-full-name">
                            {{ Sector.Sector }}
                        </label>
                        <input
                            class="appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                            id="inline-full-name" type="text" disabled v-model="Sector.Budget" />
                    </div>
                </div>
            </div>
            <div v-if="deletSectors.length" class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div v-if="deletSectors.length" class="md:flex md:items-center w-full justify-end">
                    <div class="md:w-2/3">
                        <button
                            class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                            type="submit">
                            حذف
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div v-if="showModalSector">
            <delete-modal-sector @handel-close-delete-sector-modal="handelCloseSectorModal"
                @handel-delete-sector="handeDeleteSector"></delete-modal-sector>
        </div>
    </div>
</template>

<script>
import deleteModalSector from "./delete-modal-sector.vue";
export default {
    props: ["years"],
    components: { deleteModalSector },
    data() {
        return {
            localYears: this.years,
            selectedItem: null,
            selectedYear: null,
            year: null,
            deletSectors: [],
            showModalSector: false
        };
    },
    watch: {
        years(newYears) {
            this.localYears = newYears;
        }
    },
    methods: {
        async onChangedelet(event) {
            try {
                const response = await axios.post("/SectorsBudget", {
                    year: event.target.value
                });
                this.deletSectors = response.data;
                this.selectedItem = "0";
                this.selectedYear = event.target.value;
                this.year = event.target.value;
            } catch (error) {
                console.error(error);
            }
        },
        async deleteSector() {
            this.showModalSector = true;
        },
        async handeDeleteSector() {
            try {
                await axios.post("/delet", {
                    year: this.year
                });
                this.deletSectors = [];
               await this.$emit('get-years')
                this.showModalSector = false;
            } catch (error) {
                console.error(error);
            }
        },
        handelCloseSectorModal() {
            this.showModalSector = false;
        }
    }
};
</script>
