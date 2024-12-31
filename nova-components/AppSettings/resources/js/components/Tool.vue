<template>
    <div class="p-6 max-w-lg mx-auto bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">اعدادات التطبيق</h2>
        <div>
            <div class="mb-4">
                <label for="donation" class="block text-sm font-medium text-gray-700">الحد الادنى للتبرع </label>
                <input v-model="settings.donation" type="text" id="donation"
                    placeholder=" الرجاء ادخال النص المراد اظهارة في التطبيق"
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
            </div>
            <div class="mb-4">
                <label for="latestVersion" class="block text-sm font-medium text-gray-700"> نسخة التطبيق </label>
                <input v-model="settings.latestVersion" type="text" id="latestVersion"
                    placeholder=" الرجاء ادخال نسخة التطبيق "
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
            </div>

            <div class="mb-4">
                <label for="updateLink" class="block text-sm font-medium text-gray-700"> الرابط </label>
                <input v-model="settings.updateLink" type="text" id="updateLink" placeholder=" الرجاء ادخال الرابط"
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
            </div>

            <button @click="saveSettings" :disabled="loading" class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800">
                {{ loading ? 'جاري الحفظ...' : 'حفظ' }}
            </button>
        </div>
        <p v-if="message" class="mt-4 text-green-500">{{ message }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            settings: {
                donation: '',
                latestVersion: '',
                updateLink: ''
            },
            message: '',
            loading: false // Add loading state
        };
    },
    mounted() {
        this.getSettings();
    },
    methods: {
        async getSettings() {
            try {
                const response = await axios.get('/settings');
                this.settings.donation = response.data.donation || '';
                this.settings.latestVersion = response.data.latestVersion || '';
                this.settings.updateLink = response.data.updateLink || '';
            } catch (error) {
                console.error('Error fetching settings:', error);
            }
        },
        async saveSettings() {
            this.loading = true; // Set loading to true
            try {
                await axios.post('/settings', this.settings);
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
                toastr.success("تم الحفظ  بنجاح");
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
            } finally {
                this.loading = false; // Set loading back to false
            }
        }
    }
};
</script>

<style scoped>
/* Tailwind styles will be applied directly, so no need for custom CSS here */
</style>
