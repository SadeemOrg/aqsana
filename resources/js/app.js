import { createApp } from 'vue';
import UserProfile from './components/user-profile.vue';

const app = createApp({});

// Register your Vue components here
app.component('user-profile', UserProfile);

// Mount the Vue app to the #app element
app.mount('#app');