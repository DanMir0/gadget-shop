<script setup>
import {onMounted, ref} from "vue";

const loading = ref(false)
const products = ref([]);
async function fetchNewProducts() {
    loading.value = true
    try {
        const response = await axios.get("/api/new-products");
        products.value = response.data
        loading.value = false
        console.log(products.value)
    } catch (e) {
        console.log(e)
    }
}

onMounted(async () => {
    await fetchNewProducts()
})
</script>

<template>
    <div class="products">
        <h2 class="product-title">Новые товары</h2>
        <g-loader v-if="loading">Loading...</g-loader>
        <g-products-list v-else :products="products"></g-products-list>
    </div>
</template>

<style scoped>
.products {
    margin-top: 120px;
}

.product-title {
    text-align: center;
    font-size: 48px;
    margin-bottom: 30px;
}

@media (max-width: 1200px) {
    .product-title {
        font-size: 36px;
    }
}
</style>
