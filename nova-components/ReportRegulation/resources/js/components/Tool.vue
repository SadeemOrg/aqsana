<template>
    <div class="p-10 max-w-md mx-auto bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-5">Regulation Report</h2>
        <form @submit.prevent="submitForm" class="space-y-4">
            <div class="flex flex-col">
                <label class="text-gray-600">Company Name:</label>
                <input type="text" v-model="companyName" disabled value="regulation"
                    class="border rounded-md p-2 mt-1 bg-gray-100" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-600">Business Account Number:</label>
                <input type="text" v-model="businessAccountNumber" disabled value="2312312312"
                    class="border rounded-md p-2 mt-1 bg-gray-100" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-600">File Location:</label>
                <input type="text" v-model="fileLocation" disabled value="C://Downloads"
                    class="border rounded-md p-2 mt-1 bg-gray-100" />
            </div>

            <!-- Date Picker Dropdown Section -->
            <div class="flex flex-col">
                <label class="text-gray-600">Choose Your Date:</label>
                <div class="relative">
                    <input type="text" v-model="displayDateRange" @click="toggleDatePicker" class="border rounded-md p-2 w-full cursor-pointer" placeholder="Select Date Range" readonly />
                    <div v-if="showDatePicker" class="absolute z-10 bg-white shadow-md p-4 rounded-md mt-1 w-full">
                        <div class="flex flex-col space-y-2">
                            <button @click="selectLastDays(30)" class="bg-gray-200 p-2 rounded-md">Last 30 Days</button>
                            <button @click="selectLastDays(90)" class="bg-gray-200 p-2 rounded-md">Last 90 Days</button>
                            <button @click="selectLastYear" class="bg-gray-200 p-2 rounded-md">Last Year</button>
                            <button @click="selectAllTime" class="bg-gray-200 p-2 rounded-md">All Time</button>
                        </div>
                        <div class="mt-4">
                            <label class="text-gray-600">Custom Range:</label>
                            <div class="flex space-x-2 mt-2">
                                <input type="date" v-model="customStartDate" class="border rounded-md p-2" />
                                <input type="date" v-model="customEndDate" class="border rounded-md p-2" />
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button @click="applyCustomRange" class="bg-green-500 text-white p-2 rounded-md">Apply</button>
                            <button @click="closeDatePicker" class="bg-red-500 text-white p-2 rounded-md">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="bg-green-500 text-white font-semibold p-2 rounded-md w-full hover:bg-green-600 transition-colors">
                Submit
            </button>
        </form>

        <div v-if="errorMessage" class="mt-4 text-red-500">{{ errorMessage }}</div>
        <div v-if="successMessage" class="mt-4 text-green-500">{{ successMessage }}</div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            companyName: "regulation",
            businessAccountNumber: "2312312312",
            fileLocation: "C://Downloads",
            startDate: "",
            endDate: "",
            customStartDate: "",
            customEndDate: "",
            displayDateRange: "",
            showDatePicker: false,
            errorMessage: "",
            successMessage: ""
        };
    },
    methods: {
        toggleDatePicker() {
            this.showDatePicker = !this.showDatePicker;
        },
        closeDatePicker() {
            this.showDatePicker = false;
        },
        selectLastDays(days) {
            const today = new Date();
            const pastDate = new Date(today);
            pastDate.setDate(today.getDate() - days);

            this.startDate = pastDate.toISOString().split('T')[0];
            this.endDate = today.toISOString().split('T')[0];
            this.displayDateRange = `${this.startDate} to ${this.endDate}`;
            this.showDatePicker = false;
        },
        selectLastYear() {
            const today = new Date();
            const lastYear = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());

            this.startDate = lastYear.toISOString().split('T')[0];
            this.endDate = today.toISOString().split('T')[0];
            this.displayDateRange = `${this.startDate} to ${this.endDate}`;
            this.showDatePicker = false;
        },
        selectAllTime() {
            this.startDate = "2000-01-01";
            this.endDate = new Date().toISOString().split('T')[0];
            this.displayDateRange = `${this.startDate} to ${this.endDate}`;
            this.showDatePicker = false;
        },
        applyCustomRange() {
            this.startDate = this.customStartDate;
            this.endDate = this.customEndDate;
            this.displayDateRange = `${this.startDate} to ${this.endDate}`;
            this.showDatePicker = false;
        },
        async submitForm() {
            try {
                const response = await axios.post("/report-regulation", {
                    companyName: this.companyName,
                    businessAccountNumber: this.businessAccountNumber,
                    fileLocation: this.fileLocation,
                    startDate: this.startDate,
                    endDate: this.endDate
                });

                this.successMessage = "Data submitted successfully!";
                this.errorMessage = "";
            } catch (error) {
                this.errorMessage = "Error submitting the form.";
                this.successMessage = "";
            }
        }
    }
};
</script>

<style>
/* TailwindCSS is used for styling, no additional CSS needed here */
</style>
