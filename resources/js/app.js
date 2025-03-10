import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import '../css/app.css';
import GHeader from "@/components/GHeader.vue";
import GButton from "@/components/ui/GButton.vue";  // Путь к вашему CSS файлу

const app = createApp(App);

app
    .component('g-button', GButton)
    .component('g-header', GHeader)
    .use(router)
    .mount('#app');
