import { createRouter, createWebHistory } from 'vue-router';
import Products from "@/pages/Products.vue";
import Home from "@/pages/Home.vue";

const routes = [
    {path: '/', name: 'Home', component: Home },
    {path: '/products/:category?', name: 'Products', component: Products},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
