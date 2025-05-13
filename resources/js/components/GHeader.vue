<script setup>
import {ref, onMounted, onUnmounted} from "vue";
import Products from "@/pages/Products.vue";
import router from "@/router/router.js";
import axios from "axios";

const props = defineProps({
    user: {
        type: Object,
    }
})
const menuOpen = ref(false);

function toggleMenu() {
    menuOpen.value = !menuOpen.value;
}

function closeMenu(event) {
    if (!event.target.closest(".mobile-menu") && !event.target.closest(".burger-btn")) {
        menuOpen.value = false;
    }
}

function goToRegister() {
    router.push('/register')
}

function goToLogin() {
    router.push('/login')
}

async function goToLogout() {
    const response = await axios.post('/logout')
    props.user = null
}

onMounted(() => {
    document.addEventListener("click", closeMenu);
});

onUnmounted(() => {
    document.removeEventListener("click", closeMenu);
});

</script>

<template>
    <header class="header">
        <div class="container">
            <div class="logo">
                <img alt="лого" class="logo-img" src="../images/logo2-removebg-preview.png"/>
                <p class="logo-title">Ninja Devices</p>
            </div>

            <!-- Навигация на десктопе -->
            <nav class="menu">
                <router-link :to="{name: 'Home'}" exact-active-class="active" class="menu-link">Главная</router-link>
                <router-link :to="{name: 'Products'}" exact-active-class="active" class="menu-link">Каталог
                </router-link>
                <router-link :to="{name: 'NewProducts'}" exact-active-class="active" class="menu-link">Новинки
                </router-link>
                <a href="#" class="menu-link">Скидки</a>
            </nav>

            <!-- Кнопки на десктопе -->
            <div v-if="!user" class="buttons">
                <g-button @click="goToLogin" class="btn-black">Войти</g-button>
                <g-button @click="goToRegister" class="btn-outlined">Зарегистрироваться</g-button>
            </div>

            <div v-else class="buttons">
                <router-link to="">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24.000000 24.000000"
                         preserveAspectRatio="xMidYMid meet"
                         class="icon shop-img">
                        <g transform="translate(0.000000,24.000000) scale(0.100000,-0.100000)" stroke="none">
                            <path d="M5 221 c-3 -5 5 -11 17 -13 17 -2 25 -14 34 -53 7 -27 11 -60 7 -72
-3 -13 -1 -23 5 -23 6 0 8 -9 5 -20 -4 -16 0 -20 17 -20 17 0 21 4 17 20 -4
17 0 20 33 20 33 0 37 -3 33 -20 -4 -15 0 -20 16 -20 16 0 20 6 19 25 -2 24
-5 25 -73 27 l-70 2 67 3 c36 2 70 9 75 16 9 11 33 86 33 101 0 3 -40 6 -89 6
-70 0 -90 3 -95 15 -6 16 -41 20 -51 6z m215 -50 c0 -4 -5 -22 -11 -40 -11
-30 -13 -31 -70 -31 -32 0 -59 4 -59 9 0 5 -3 23 -6 40 l-6 31 76 0 c42 0 76
-4 76 -9z"/>
                        </g>
                    </svg>
                </router-link>
                <router-link class="favorite" to="">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512.000000 457.000000"
                         preserveAspectRatio="xMidYMid meet"
                         class="icon favorite-img">
                        <g transform="translate(0.000000,457.000000) scale(0.100000,-0.100000)"
                           stroke="none">
                            <path d="M1335 4559 c-628 -86 -1133 -533 -1285 -1134 -74 -290 -64 -577 30
-856 62 -187 141 -331 270 -494 82 -104 1951 -1977 2010 -2014 55 -36 138 -61
200 -61 55 0 141 24 190 52 45 27 1854 1830 1972 1967 197 227 308 448 369
731 31 140 33 436 6 575 -64 317 -198 567 -426 796 -230 229 -488 367 -802
425 -143 27 -430 25 -565 -4 -254 -55 -502 -174 -676 -323 -31 -27 -61 -49
-66 -49 -6 0 -34 21 -64 46 -178 153 -424 271 -675 324 -114 24 -377 35 -488
19z"/>
                        </g>
                    </svg>
                </router-link>
                <g-button @click="goToLogout" class="btn-black">Выйти</g-button>
            </div>

            <!-- Бургер-кнопка -->
            <button class="burger-btn" @click="toggleMenu">
                <span :class="{'burger-bar': true, 'open-bar1': menuOpen}"></span>
                <span :class="{'burger-bar': true, 'open-bar2': menuOpen}"></span>
                <span :class="{'burger-bar': true, 'open-bar3': menuOpen}"></span>
            </button>
        </div>

        <!-- Мобильное бургер-меню -->
        <div :class="{'mobile-menu': true, 'mobile-menu-open': menuOpen}">
            <div class="mobile-logo">
                <img class="logo-img" src="../images/logo2-removebg-preview.png"/>
                <p class="logo-title">Ninja Devices</p>
            </div>
            <nav class="mobile-nav">
                <router-link :to="{name: 'Home'}" activeClass="active" class="menu-link">Главная</router-link>
                <router-link :to="{name: 'Products'}" activeClass="active" class="menu-link">Каталог</router-link>
                <a href="#" class="menu-link">Новинки</a>
                <a href="#" class="menu-link">Скидки</a>
            </nav>
            <div v-if="!user" class="mobile-buttons">
                <g-button @click="goToLogin" class="btn-black">Войти</g-button>
                <g-button @click="goToRegister" class="btn-outlined">Зарегистрироваться</g-button>
            </div>
            <div v-else class="buttons">
                <router-link class="favorite" to="">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512.000000 457.000000"
                         preserveAspectRatio="xMidYMid meet"
                         class="icon favorite-img">
                        <g transform="translate(0.000000,457.000000) scale(0.100000,-0.100000)"
                           stroke="none">
                            <path d="M1335 4559 c-628 -86 -1133 -533 -1285 -1134 -74 -290 -64 -577 30
-856 62 -187 141 -331 270 -494 82 -104 1951 -1977 2010 -2014 55 -36 138 -61
200 -61 55 0 141 24 190 52 45 27 1854 1830 1972 1967 197 227 308 448 369
731 31 140 33 436 6 575 -64 317 -198 567 -426 796 -230 229 -488 367 -802
425 -143 27 -430 25 -565 -4 -254 -55 -502 -174 -676 -323 -31 -27 -61 -49
-66 -49 -6 0 -34 21 -64 46 -178 153 -424 271 -675 324 -114 24 -377 35 -488
19z"/>
                        </g>
                    </svg>
                </router-link>
                <g-button @click="goToLogout" class="btn-black">Выйти</g-button>
            </div>
        </div>
    </header>
</template>

<style scoped>
.icon {
    width: 24px;
    height: 24px;
    fill: #000000;
    transition: fill 0.3s ease;
    cursor: pointer;
}

.shop-img:hover {
    fill: #666666;
}

.favorite-img:hover {
    fill: #ff0000;
}

.header {
    background-color: #FFFFFF;
    padding: 15px 0;
}

.container {
    max-width: 1600px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
}

.logo {
    display: flex;
    align-items: center;
}

.logo-img {
    height: 100px;
}

.logo-title {
    font-size: 40px;
    font-weight: bold;
}

/* Обычное меню */
.menu {
    display: flex;
    gap: 20px;
    font-size: 20px;
}

.buttons {
    display: flex;
    align-items: center;
    gap: 15px;
}

.btn-black {
    background-color: #000000;
    color: #FFFFFF;
}

.btn-outlined {
    border: 1px solid #000000;
}

/* Бургер-кнопка */
.burger-btn {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    width: 35px;
    height: 25px;
    cursor: pointer;
    background: none;
    border: none;
    z-index: 100;
    position: relative;
}

.burger-bar {
    width: 35px;
    height: 4px;
    background-color: black;
    transition: all 0.3s ease;
}

/* Анимация бургера */
.open-bar1 {
    transform: rotate(45deg) translate(7px, 7px);
}

.open-bar2 {
    opacity: 0;
}

.open-bar3 {
    transform: rotate(-45deg) translate(7px, -7px);
}

/* Мобильное меню */
.mobile-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh; /* Можно изменить на 50vh для половины экрана */
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
    transform: translateY(-100%);
    transition: transform 0.3s ease-in-out;
    z-index: 99;
}

.mobile-menu-open {
    transform: translateY(0);
}

.mobile-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.mobile-nav {
    display: flex;
    flex-direction: column;
    gap: 20px;
    text-align: center;
}

.mobile-buttons {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.menu-link:hover {
    color: #FFA542;
}

.active {
    color: #FFA542;
    text-decoration: underline 1px solid #FFA542;
}

/* Медиа-запросы */
@media (max-width: 1200px) {
    .menu, .buttons {
        display: none; /* Скрываем меню и кнопки на мобильных */
    }

    .burger-btn {
        display: flex;
    }
}

@media (max-width: 768px) {
    .logo-title {
        font-size: 28px;
    }
}

@media (max-width: 500px) {
    .logo-img {
        height: 80px;
    }

    .logo-title {
        font-size: 24px;
    }
}
</style>
