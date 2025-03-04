<template>
    <header class="bg-gray-800 text-white">
        <div class=" mx-auto px-4 py-4 flex items-center justify-between w-full">
            <!-- Логотип (слева) -->
            <div class="flex items-center space-x-4">
                <img src="/resources/assets/images/logo2-removebg-preview.png" alt="Логотип магазина" class="h-16">
                <p class="font-extrabold text-3xl text-white">Ninja Devices</p>
            </div>

            <!-- Меню (по центру) -->
            <nav class="flex-grow flex justify-center space-x-6 text-xl text-gray-300">
                <a href="#" class="hover:text-gray-400 transition-colors">Главная</a>
                <a href="#" class="hover:text-gray-400 transition-colors">Категории</a>
                <a href="#" class="hover:text-gray-400 transition-colors">Новинки</a>
                <a href="#" class="hover:text-gray-400 transition-colors">Скидки</a>
            </nav>

            <!-- Кнопки (справа) -->
            <div class="flex items-center space-x-4">
                <button @click="" class="p-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors focus:outline-none">
                    Войти
                </button>
                <button @click="" class="p-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition-colors focus:outline-none">
                    Зарегистрироваться
                </button>
            </div>
        </div>
    </header>
</template>

<script setup>
</script>

<style scoped>
/* Настроим кнопки */
button {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

button:hover {
    transform: translateY(-2px);
}

button:active {
    transform: translateY(0);
}
</style>
