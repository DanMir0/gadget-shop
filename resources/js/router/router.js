import {createRouter, createWebHistory} from 'vue-router';
import Products from "@/pages/Products.vue";
import Home from "@/pages/Home.vue";
import Register from "@/pages/Register.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";
import Login from "@/pages/Login.vue";
import New from "@/pages/New.vue"
import TermsOfUse from "@/pages/TermsOfUse.vue";
import Favorites from "@/pages/Favorites.vue";
import ForgotPassword from "@/pages/ForgotPassword.vue";
import ResetPassword from "@/pages/ResetPassword.vue";
import Cart from "@/pages/Cart.vue";
import {useAuthStore} from "@/stores/auth.js";
import AboutUs from "@/pages/AboutUs.vue";
import {useLangStore} from "@/stores/lang.js";

const routes = [
    {
        path: '/:lang',
        component: DefaultLayout,
        children: [
            {path: '', name: 'Home', component: Home},
            {
                path: 'products/:category?',
                name: 'Products',
                component: Products,
                meta: {title: "Магазин - Все товары", description: "Все товары в магазине"},
            },
            {
                path: 'new-products',
                name: 'NewProducts',
                component: New,
                meta: {title: "Новинки", description: "Только свежие новые товары"},
            },
            {
                path: 'terms-of-use',
                name: 'TermsOfUse',
                component: TermsOfUse,
                meta: {title: "Условия сервеса"},
            },
            {
                path: 'favorites',
                name: 'Favorites',
                component: Favorites,
                meta: {title: "Избранное", requiresAuth: true},
            },
            {
                path: 'cart',
                name: 'Cart',
                component: Cart,
                meta: {title: "Корзина", requiresAuth: true},
            },
            {
                path: 'about-us',
                name: 'AboutUs',
                component: AboutUs,
                meta: {title: "О нас"},
            },
        ]
    },
    {
        path: '/:lang',
        name: 'AuthLayout',
        component: AuthLayout,
        children: [
            {
                path: 'register',
                name: 'Register',
                component: Register,
                meta: {title: "Регистрация"}
            },
            {
                path: 'login',
                name: 'Login',
                component: Login,
                meta: {title: "Войти"}
            },
            {
                path: 'forgot-password',
                name: 'ForgotPassword',
                component: ForgotPassword,
                meta: {title: "Забыли пароль"},
            },
            {
                path: 'reset-password',
                name: 'ResetPassword',
                component: ResetPassword,
                props: true
            }
        ]
    },
    {
        path: '/',
        redirect: '/ru'
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const langStore = useLangStore();

    const lang = to.params.lang;
    const supportedLangs = ['ru', 'en'];

    if (!supportedLangs.includes(lang)) {
        return next('/ru');
    }
    langStore.setLang(lang)

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

    const auth = useAuthStore();

    // Если авторизация ещё не проверена, подгружаем пользователя
    if (to.meta.requiresAuth && !auth.isAuthenticated) {
        return next({ name: 'Login', params: { lang } });
    }

    const protectedPages = ['/cart', '/favorites',]; // тут укажи свои защищённые страницы

    if (protectedPages.includes(to.path) && !auth.isAuthenticated) {
        return next('/login'); // редирект на страницу входа
    }

    next();

})

export default router;
