<template>
    <card class="flex flex-col">
        <form @submit.prevent="send" method="get">
            <div class="mb-6 p-12">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    اختر الفئة
                </label>
                <div class="relative">
                    <div @click="toggleDropdown"
                        class="w-full form-control form-input form-input-bordered  cursor-pointer bg-white border border-gray-200 rounded px-4 py-2 flex items-center justify-between">
                        <span>{{ selectedText }}</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.707a1 1 0 011.414 0L10 11.414l3.293-3.707a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div v-show="isOpen"
                        class="absolute w-full bg-white border border-gray-200 rounded mt-1 max-h-60 overflow-y-auto z-10">
                        <input type="text" v-model="searchQuery"
                            class="w-full form-control form-input form-input-bordered mb-2 px-4 py-2 border-gray-200 rounded-md"
                            placeholder="Search...">
                        <div v-for="type in filteredTypes" :key="type.id"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100" @click="toggleSelect(type)">
                            <input type="checkbox" :value="type.id" v-model="selectval" class="mr-2">{{ type.name }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    ادخل نص الرسالة
                </label>
                <textarea
                    id="message"
                    v-on:keyup="countdown"
                    v-model="Message"
                    cols="30"
                    rows="10"
                    class="appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black"></textarea>
                <p class='text-right text-small' v-bind:class="{ 'text-danger': hasError }">{{ remainingCount }}</p>
                <div class="flex flex-row items-center justify-end mt-4">
                    <button type="submit"
                        class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded">
                        ارسال
                    </button>
                </div>
            </div>
        </form>
    </card>
</template>

<script>
export default {
    data() {
        return {
            Message: "",
            selectval: [], // Change this to an array for multi-select
            Types: [],
            maxCount: 140,
            remainingCount: 140,
            hasError: false,
            isOpen: false,
            searchQuery: ""
        };
    },
    props: ["card"],
    beforeMount() {
        this.getType();
    },
    computed: {
        selectedText() {
            if (this.selectval.length === 0) {
                return "اختر الفئة";
            }
            return this.Types.filter(type => this.selectval.includes(type.id))
                .map(type => type.name)
                .join(", ");
        },
        filteredTypes() {
            return this.Types.filter(type => {
                return type.name.toLowerCase().includes(this.searchQuery.toLowerCase());
            });
        }
    },
    methods: {
        async send() {
            try {
                const response = await axios.get('/SendMessageSms', {
                    params: {
                        type: this.selectval,
                        Message: this.Message
                    }
                });
                toastr.success('تم ارسال الرسالة');
            } catch (error) {
                toastr.error('فشل في إرسال رسالة');
            }
        },
        getType() {
            axios.post("/getType").then(response => {
                this.Types = response.data;
            });
        },
        countdown: function () {
            this.remainingCount = this.maxCount - this.Message.length;
            this.hasError = this.remainingCount < 0;
        },
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        toggleSelect(type) {
            const index = this.selectval.indexOf(type.id);
            if (index > -1) {
                this.selectval.splice(index, 1);
            } else {
                this.selectval.push(type.id);
            }
        },
        onSubmit() {
            this.send();
        }
    }
};
</script>

<style>
.card {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
}
</style>
