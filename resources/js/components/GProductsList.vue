<script setup>
const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
    path: {
        type: String,
    },
    isCart: Boolean
})

defineEmits(['remove-from-favorites'])
</script>

<template>
    <div class="lists">
        <g-product :class="['product-card', { 'cart-card': isCart }]" @remove-from-favorites="$emit('remove-from-favorites', product)" :path="props.path" v-for="product in props.products" :key="product.id" :product="product"></g-product>

    </div>
</template>

<style scoped>
.cart-card {
    min-height: 420px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    min-width: 280px !important;
    width: 100%;
    box-sizing: border-box;
}

.cart-card img {
    height: 160px;
    object-fit: contain;
    margin: 0 auto;
}

.lists {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-content: center;
}

@media (max-width: 500px) {
    .lists {
        grid-template-columns: 1fr;
        gap: 15px;
        padding: 0 10px 30px;
        align-items: center;
    }
}
</style>
