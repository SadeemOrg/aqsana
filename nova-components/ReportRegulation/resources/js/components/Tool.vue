<template >
    <div class="p-10 max-w-2xl mx-auto bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl text-center font-bold mb-5">Regulation Report</h2>
        <form dir="ltr" @submit.prevent="submitForm" class="space-y-4">
            <div class="flex flex-row-reverse items-center justify-start gap-6 w-full ">

                <div style="width: 33%;" class="flex flex-col items-end ">
                    <label class="text-gray-600 font-bold">Company Name</label>
                    <input style="text-align: end;" type="text" v-model="companyName" disabled value="regulation"
                        class="border text-left rounded-md p-2 mt-1 bg-gray-100 w-full" />
                </div>

                <div style="width: 33%;" class="flex flex-col items-end">
                    <label class="text-gray-600 font-bold">File Location</label>
                    <input style="text-align: end;" type="text" v-model="fileLocation" disabled value="C://Downloads"
                        class="border text-left rounded-md p-2 mt-1 bg-gray-100 w-full" />
                </div>
                <!-- Date Picker Dropdown Section -->
                <div style="width: 33%;" class="flex flex-col items-end">
                    <label class="text-gray-600 font-bold">Choose Your Date</label>
                    <div class="relative w-full">
                        <input style="text-align: end;" type="text" v-model="displayDateRange" @click="toggleDatePicker"
                            class="border rounded-md p-2 w-full cursor-pointer" placeholder="Select Date Range" readonly />
                        <div v-if="showDatePicker" class="absolute z-10 bg-white shadow-md p-4 rounded-md mt-1 w-full">
                            <div class="flex flex-row-reverse space-x-4 mb-4">
                                <button @click="setActiveTab('days')" :class="{'bg-gray-200': activeTab === 'days'}" class="p-2 rounded-md">Days</button>
                                <button @click="setActiveTab('weeks')" :class="{'bg-gray-200': activeTab === 'weeks'}" class="p-2 rounded-md">Weeks</button>
                                <button @click="setActiveTab('months')" :class="{'bg-gray-200': activeTab === 'months'}" class="p-2 rounded-md">Months</button>
                                <button @click="setActiveTab('years')" :class="{'bg-gray-200': activeTab === 'years'}" class="p-2 rounded-md">Years</button>
                            </div>
                             <!-- Days Tab -->
                             <div v-if="activeTab === 'days'" class="flex flex-col space-y-2">
                                <button @click="selectLastDays(7)" class="bg-gray-200 p-2 rounded-md">Last 7 Days</button>
                                <button @click="selectLastDays(14)" class="bg-gray-200 p-2 rounded-md">Last 14 Days</button>
                                <button @click="selectLastDays(30)" class="bg-gray-200 p-2 rounded-md">Last 30 Days</button>
                            </div>
                            <!-- Weeks Tab -->
                            <div v-if="activeTab === 'weeks'" class="flex flex-col space-y-2">
                                <button @click="selectLastWeeks(1)" class="bg-gray-200 p-2 rounded-md">Last 1 Week</button>
                                <button @click="selectLastWeeks(2)" class="bg-gray-200 p-2 rounded-md">Last 2 Weeks</button>
                                <button @click="selectLastWeeks(4)" class="bg-gray-200 p-2 rounded-md">Last 4 Weeks</button>
                            </div>
                              <!-- Months Tab -->
                              <div v-if="activeTab === 'months'" class="flex flex-col space-y-2">
                                <button @click="selectLastMonths(1)" class="bg-gray-200 p-2 rounded-md">Last 1 Month</button>
                                <button @click="selectLastMonths(3)" class="bg-gray-200 p-2 rounded-md">Last 3 Months</button>
                                <button @click="selectLastMonths(6)" class="bg-gray-200 p-2 rounded-md">Last 6 Months</button>
                            </div>

                            <!-- Years Tab -->
                            <div v-if="activeTab === 'years'" class="flex flex-col space-y-2">
                                <button @click="selectLastYears(1)" class="bg-gray-200 p-2 rounded-md">Last 1 Year</button>
                                <button @click="selectLastYears(2)" class="bg-gray-200 p-2 rounded-md">Last 2 Years</button>
                            </div>

                               <!-- Custom Range -->
                               <div class="mt-4 flex flex-col items-end">
                                <label class="text-gray-600 pr-2 font-bold">Custom Range</label>
                                <div class="flex flex-col gap-4 mx-2 mt-2 w-full">
                                    <label for="date_from" style="text-align: left;" class="font-bold">Date From
                                        <input type="date" name="date_from" v-model="customStartDate"
                                            class="border rounded-md p-2 w-full" />
                                    </label>
                                    <label for="date_to" style="text-align: left;" class="font-bold">Date To
                                        <input type="date" name="date_to" v-model="customEndDate" class="border rounded-md p-2 w-full" />
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 flex gap-x-4 ">
                                <button @click="applyCustomRange" style="background-color:#16803C"
                                    class=" text-white p-2 rounded-md">Apply</button>
                                <button @click="closeDatePicker"
                                    class="bg-red-500 text-white p-2 rounded-md">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-row-reverse items-center justify-start gap-6 w-full ">
                <div style="width: 33%;" class="flex flex-col items-end my-4">
                    <label class="text-gray-600 font-medium">Company Name</label>
                    <input style="text-align: end;" type="text" v-model="companyName" disabled value="regulation"
                        class=" text-left font-medium bg-white py-2 mt-1 w-full" />
                </div>
                <div style="width: 33%;" class="flex flex-col items-end my-4">
                    <label class="text-gray-600 font-medium">Business Account Number</label>
                    <input style="text-align: end;" type="text" v-model="companyName" disabled value="231231231231"
                        class=" text-left font-medium bg-white py-2 mt-1 w-full" />
                </div>

                <div style="width: 33%;" class="flex flex-col items-end my-4">
                    <label class="text-gray-600 font-medium">Company Name</label>
                    <input style="text-align: end;" type="text" v-model="companyName" disabled value="xxxss11"
                        class=" text-left font-medium bg-white py-2 mt-1 w-full" />
                </div>
            </div>
            <!-- Date Picker Dropdown Section -->
            <button type="submit" style="background-color:#16803C"
                class=" text-white font-semibold p-2 rounded-md w-full hover:bg-green-600 transition-colors">
                Submit
            </button>
        </form>

        <div v-if="errorMessage" class="mt-4 text-red-500">{{ errorMessage }}</div>
        <div v-if="successMessage" class="mt-4 text-green-500">
            {{ successMessage }}
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            companyName: "regulation",
            businessAccountNumber: "231231231231",
            fileLocation: "C://Downloads",
            customStartDate: "",
            customEndDate: "",
            displayDateRange: "",
            showDatePicker: false,
            activeTab: 'days', 
            errorMessage: "",
            successMessage: "",
        };
    },
    methods: {
        toggleDatePicker() {
            this.showDatePicker = !this.showDatePicker;
        },
        closeDatePicker() {
            this.showDatePicker = false;
        },
        setActiveTab(tab) {
            this.activeTab = tab;
        },
        selectLastDays(days) {
            const today = new Date();
            const pastDate = new Date(today);
            pastDate.setDate(today.getDate() - days);
            this.displayDateRange = `${pastDate.toISOString().split("T")[0]} ---- ${today.toISOString().split("T")[0]}`;
            this.showDatePicker = false;
        },
        selectLastWeeks(weeks) {
            this.selectLastDays(weeks * 7);
        },
        selectLastMonths(months) {
            const today = new Date();
            const pastDate = new Date(today);
            pastDate.setMonth(today.getMonth() - months);
            this.displayDateRange = `${pastDate.toISOString().split("T")[0]} ----  ${today.toISOString().split("T")[0]}`;
            this.showDatePicker = false;
        },
        selectLastYears(years) {
            const today = new Date();
            const pastDate = new Date(today);
            pastDate.setFullYear(today.getFullYear() - years);
            this.displayDateRange = `${pastDate.toISOString().split("T")[0]} ---- ${today.toISOString().split("T")[0]}`;
            this.showDatePicker = false;
        },
        applyCustomRange() {
            this.displayDateRange = `${this.customStartDate} ---- ${this.customEndDate}`;
            this.showDatePicker = false;
        },
        async submitForm() {
            try {
                const response = await axios.post("/report-regulation", {
                    companyName: this.companyName,
                    businessAccountNumber: this.businessAccountNumber,
                    fileLocation: this.fileLocation,
                    dateRange: this.displayDateRange,
                });

                this.successMessage = "Data submitted successfully!";
                this.errorMessage = "";
            } catch (error) {
                this.errorMessage = "Error submitting the form.";
                this.successMessage = "";
            }
        },
    },
};
</script>

<style>
/* TailwindCSS is used for styling, no additional CSS needed here */
</style>
