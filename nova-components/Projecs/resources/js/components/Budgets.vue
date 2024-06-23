<template>
    <div>
        <div class="py-4 w-[95%] bg-slate-700">
            <div class="md:w-1/3">
                <label
                    class="block text-black text-base ml-4 py-2 font-medium md:text-right mb-1 md:mb-0"
                >
                    السنة
                </label>
            </div>
            <select
                class="select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm"
                @change="onChange($event)"
                v-model="year"
            >
                <option selected disabled value="0">
                    الرجاء اختيار السنة
                </option>
                <option
                    v-for="year in years"
                    :key="year.year"
                    :value="year.year"
                >
                    {{ year.year }}
                </option>
            </select>
        </div>
        <form @submit.prevent="save" class="add-form py-4">
            <div
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-4"
            >
                <div
                    v-for="(Sector, index) in Sectors"
                    :key="Sector.Sector"
                    :value="Sector.Sector"
                    class=""
                >
                    <div class="mb-3">
                        <label
                            class="block text-gray-500 font-medium md:text-right mb-2 md:mb-0 text-sm w-64"
                            :for="index"
                        >
                            {{ Sector.Sector }}
                        </label>
                        <input
                            v-on:keyup="countdown"
                            class=" appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"
                            :id="index"
                            type="text"
                            v-model="Sector.Budget"
                        />
                    </div>
                </div>
            </div>
            <div
                v-if="Sectors.length"
                class="md:flex md:items-center w-full justify-start py-4"
            >
                <p
                    class="text-right text-small"
                    v-bind:class="{ 'text-danger': hasError }"
                >
                    المجموع: {{ remainingCount }}
                </p>
            </div>
            <div
                v-if="Sectors.length"
                class="md:flex md:items-center w-full justify-end"
            >
                <div class="md:w-2/3">
                    <button
                        class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded"
                        type="submit"
                    >
                        حفظ
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ["years", "year"],
    data() {
        return {
            openTab: 1,
            openTabstatistic: 0,
            Sectors: [],
            totalSectorYear: 0,
            sumSectorsPerYear: 0,
            remainingCount: 0,
            hasError: false
        };
    },
    methods: {
        async save() {
            this.sumSectorsPerYear = 0;
            this.totalSectorYear = 0;
            this.Sectors.forEach(sector => {
                if (sector.sector_id === 0) {
                    this.totalSectorYear = parseInt(sector.Budget);
                }
            });
            this.Sectors.forEach(sector => {
                if (sector.sector_id != 0) {
                    if (sector.Budget) {
                        this.sumSectorsPerYear += parseInt(sector.Budget);
                    }
                }
            });
            if (this.sumSectorsPerYear <= this.totalSectorYear) {
                try {
                    const response = await axios.post("/save", {
                        year: this.year,
                        Sectors: this.Sectors
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
                    toastr.success("تم حفظ الميزانية بنجاح");
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
                    toastr.error("خطأ في الحفظ");
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
        },
        countdown: function() {
            this.sumSectorsPerYear = 0;
            this.totalSectorYear = 0;
            this.Sectors.forEach(sector => {
                if (sector.sector_id === 0) {
                    this.totalSectorYear = parseInt(sector.Budget);
                }
            });
            this.Sectors.forEach(sector => {
                if (sector.sector_id != 0) {
                    if (sector.Budget) {
                        this.sumSectorsPerYear += parseInt(sector.Budget);
                    }
                }
            });
            this.remainingCount = this.totalSectorYear - this.sumSectorsPerYear;
            this.hasError = this.sumSectorsPerYear > this.totalSectorYear;
        },
        async onChange(event) {
            try {
                const response = await axios.post("/SectorsBudget", {
                    year: event.target.value
                });
                this.Sectors = response.data;
                this.countdown();
            } catch (error) {
                // Handle error if needed
                console.error(error);
            }
        }
    }
};
</script>
