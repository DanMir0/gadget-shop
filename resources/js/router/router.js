import { createRouter, createWebHistory } from 'vue-router';
import Products from "@/pages/Products.vue";
import Home from "@/pages/Home.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/products/',
        name: 'Products',
        component: Products,
        meta: {title: "Магазин - Все товары", description: "Все товары в магазине" },
    },
    {
        path: '/products/:category?',
        name: 'Category',
        component: Products,
        meta: {title: "Категория товаров"},
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title || "Магазин";

    if (to.meta.description) {
        let metaDesc = document.querySelector('meta[name="description"]');
        if (metaDesc) {
            metaDesc.setAttribute("content", to.meta.description);
        } else {
            metaDesc = document.createElement("meta");
            metaDesc.setAttribute("name", "description");
            metaDesc.setAttribute("content", to.meta.description);
            document.head.appendChild(metaDesc);
        }
    }

    next();
})

export default router;
