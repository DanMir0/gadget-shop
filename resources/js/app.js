import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from "@/router/router.js";
import '../css/app.css';
import GHeader from "@/components/GHeader.vue";
import GButton from "@/components/ui/GButton.vue";
import GTitlePage from "./components/GTitlePage.vue";
import GMain from "@/components/GMain.vue";
import GCategoriesMenu from "@/components/GCategoriesMenu.vue";
import GContainer from "@/components/GContainer.vue";
import GProductsList from "@/components/GProductsList.vue";
import GProduct from "@/components/GProduct.vue";
import GBreadcrumb from "@/components/GBreadcrumb.vue";

const app = createApp(App);

app
    .component('g-breadcrumbs', GBreadcrumb)
    .component('g-product', GProduct)
    .component('g-products-list', GProductsList)
    .component('g-container', GContainer)
    .component('g-main', GMain)
    .component('g-title-page', GTitlePage)
    .component('g-button', GButton)
    .component('g-header', GHeader)
    .component('g-categories-menu', GCategoriesMenu)
    .use(router)
    .mount('#app');
