<template>
    <div class="p-6 max-w-lg mx-auto bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">اعدادات التطبيق</h2>
        <form @submit.prevent="saveSettings">
            <div class="mb-4">
                <label for="donation" class="block text-sm font-medium text-gray-700">الحد الادنى للتبرع  </label>
                <input v-model="settings.donation" type="text" id="donation" placeholder=" الرجاء ادخال النص المراد اظهارة في التطبيق"
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
            </div>

            <button type="submit" class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800">حفظ</button>
        </form>
        <p v-if="message" class="mt-4 text-green-500">{{ message }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            settings: {
                donation: ''
            },
            message: ''
        };
    },
    mounted() {
        this.getSettings();
    },
    methods: {
        async getSettings() {
            try {
                const response = await axios.get('/settings');
                // Assuming the response returns the setting as an object with keys like {donation: 'value'}
                this.settings.donation = response.data.donation || ''; // Set the value if it exists
            } catch (error) {
                console.error('Error fetching settings:', error);
            }
        },
        async saveSettings() {
            try {
                const response = await axios.post('/settings', this.settings);
                this.message = response.data.message;
            } catch (error) {
                this.message = 'Error saving settings.';
            }
        }
    }
};
</script>

<style scoped>
/* Tailwind styles will be applied directly, so no need for custom CSS here */
</style>
