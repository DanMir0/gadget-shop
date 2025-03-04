import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import GHeader from "@/components/GHeader.vue";
import '../css/app.css';  // Путь к вашему CSS файлу

const app = createApp(App);

app
    .component('g-header', GHeader)
    .use(router)
    .mount('#app');
