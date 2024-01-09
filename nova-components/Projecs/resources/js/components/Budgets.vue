<template>
    <div>
        <div class="py-4 w-[95%] bg-slate-700">
            <div class="md:w-1/3">
                <label class="block text-black text-base ml-4 py-2 font-medium md:text-right mb-1 md:mb-0">
                    السنة
                </label>
            </div>
            <select
                class="select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                @change="onChange($event)" v-model="year">
                <option selected disabled value="0">
                    الرجاء اختيار السنة
                </option>
                <option v-for="year in years" :key="year.year" :value="year.year">
                    {{ year.year }}
                </option>
            </select>
        </div>
        <form @submit.prevent="onSubmit" class="add-form py-4">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-4">
                <div v-for="(Sector, index) in Sectors" :key="Sector.Sector" :value="Sector.Sector" class="">
                    <div class="mb-3">
                        <label class="block text-gray-500 font-medium md:text-right mb-2 md:mb-0 text-sm w-64" :for="index">
                            {{ Sector.Sector }}
                        </label>
                        <input
                            class=" appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                            :id="index" type="text" v-model="Sector.Budget" />
                    </div>
                </div>
            </div>
            <div v-if="Sectors.length" class="md:flex md:items-center w-full justify-end">
                <div class="md:w-2/3">
                    <button
                        class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                        type="submit" @click="save()">
                        حفظ
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['years','year'],
    data() {
        return {
            openTab: 1,
            openTabstatistic: 0,
            Sectors: [],
        };
    },
    methods: {
        save() {
            axios.post("/save", {
                year: this.year,
                Sectors: this.Sectors,
            }).then(function (response) {
                toastr.options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "2000",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                };
                toastr.success("  تم حفظ بنجاح");
            });;
        },
        onChange(event) {
            axios
                .post("/SectorsBudget", {
                    year: event.target.value,
                })
                .then((response) => {
                    this.Sectors = response.data;
                });
        },
    },
}
</script>
