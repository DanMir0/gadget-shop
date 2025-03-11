import { createRouter, createWebHistory } from 'vue-router';
import Products from "@/pages/Products.vue";

const routes = [
    {path: '/', name: 'Products', component: Products },
    {path: '/products', name: 'Products', component: Products},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
