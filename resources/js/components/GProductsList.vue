<script setup>
const props = defineProps({
    products: {
        type: Array,
        required: true,
    }
})
</script>

<template>
    <div class="lists">
        <g-product v-for="product in props.products" :key="product.id" :product="product"></g-product>

    </div>
</template>

<style scoped>
.lists {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-content: center;
}
</style>
