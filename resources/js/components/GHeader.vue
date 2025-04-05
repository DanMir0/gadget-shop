<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import Products from "@/pages/Products.vue";

const menuOpen = ref(false);

function toggleMenu() {
    menuOpen.value = !menuOpen.value;
}

function closeMenu(event) {
    if (!event.target.closest(".mobile-menu") && !event.target.closest(".burger-btn")) {
        menuOpen.value = false;
    }
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
                <img alt="лого" class="logo-img" src="../images/logo2-removebg-preview.png" />
                <p class="logo-title">Ninja Devices</p>
            </div>

            <!-- Навигация на десктопе -->
            <nav class="menu">
                <a href="#" class="menu-link">Главная</a>
                <router-link :to="{name: 'Products'}" class="menu-link">Каталог</router-link>
                <a href="#" class="menu-link">Категории</a>
                <a href="#" class="menu-link">Новинки</a>
                <a href="#" class="menu-link">Скидки</a>
            </nav>

            <!-- Кнопки на десктопе -->
            <div class="buttons">
                <g-button class="btn-black">Войти</g-button>
                <g-button class="btn-outlined">Зарегистрироваться</g-button>
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
                <img class="logo-img" src="../images/logo2-removebg-preview.png" />
                <p class="logo-title">Ninja Devices</p>
            </div>
            <nav class="mobile-nav">
                <a href="#" class="menu-link">Главная</a>
                <a href="#" class="menu-link">Категории</a>
                <a href="#" class="menu-link">Новинки</a>
                <a href="#" class="menu-link">Скидки</a>
            </nav>
            <div class="mobile-buttons">
                <g-button class="btn-black">Войти</g-button>
                <g-button class="btn-outlined">Зарегистрироваться</g-button>
            </div>
        </div>
    </header>
</template>

<style scoped>
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
