<script setup>
defineProps({
    hoverClass: String // Пропс для передаваемого класса
});
</script>

<template>
    <button class="hoverClass">
        <slot></slot>
    </button>
</template>

<style scoped>
button {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    padding: 15px 25px;
    border-radius: 20px;
}

/* Стили по умолчанию */
button:hover {
    transform: translateY(-2px);
}

button:active {
    transform: translateY(0);
}
</style>
