import { createRouter, createWebHistory } from 'vue-router';
import Products from "@/pages/Products.vue";
import Home from "@/pages/Home.vue";
import Register from "@/pages/Register.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";
import Login from "@/pages/Login.vue";

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {path: '/', name: 'Home', component: Home},
            {
                path: '/products',
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
        ]
    },


    {
        path: '/',
        name: 'AuthLayout',
        component: AuthLayout,
        children: [
            {path: 'register', name: 'Register', component: Register},
            {path: '/login', name: 'Login', component: Login},
        ]
    },
];

// { path: '/:lang/', name: 'Home', component: Home },
// { path: '/:lang/products', name: 'Products', component: Products },
// { path: '/:lang/products/:category', name: 'ProductCategory', component: Products },
// { path: '/', redirect: '/ru/' } // Редирект на русский по умолчанию

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
