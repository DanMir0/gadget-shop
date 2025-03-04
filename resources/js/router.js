import { createRouter, createWebHistory } from 'vue-router';
import Products from "@/pages/Products.vue";

const routes = [
    {path: '/products', component: Products},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
