import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from "pinia";
import App from './components/App.vue';
import router from "./router/router.js";
import '../css/app.css';
import GHeader from "./components/GHeader.vue";
import GButton from "./components/ui/GButton.vue";
import GTitlePage from "./components/GTitlePage.vue";
import GMain from "./components/GMain.vue";
import GCategoriesMenu from "./components/GCategoriesMenu.vue";
import GContainer from "./components/GContainer.vue";
import GProductsList from "./components/GProductsList.vue";
import GProduct from "./components/GProduct.vue";
import GBreadcrumb from "./components/GBreadcrumb.vue";
import GLoader from "./components/GLoader.vue";
import GFooter from "./components/GFooter.vue";
import GNewProducts from "./components/GNewProducts.vue";
import GPagination from "./components/GPagination.vue";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const app = createApp(App);

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate)

app
    .component('g-pagination', GPagination)
    .component('g-footer', GFooter)
    .component('g-loader', GLoader)
    .component('g-breadcrumb', GBreadcrumb)
    .component('g-product', GProduct)
    .component('g-products-list', GProductsList)
    .component('g-container', GContainer)
    .component('g-main', GMain)
    .component('g-title-page', GTitlePage)
    .component('g-button', GButton)
    .component('g-new-products', GNewProducts)
    .component('g-header', GHeader)
    .component('g-categories-menu', GCategoriesMenu)
    .use(pinia)
    .use(router)
    .mount('#app');
