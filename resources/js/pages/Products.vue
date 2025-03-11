<script setup>
import {onMounted, ref} from "vue";

const selectedCategory = ref(0);
const products = ref([]);
const loading = ref(false);


async function fetchProducts() {
    loading.value = true;
    try {
        const response = await axios.get(`/api/products`, {
            params: {category: selectedCategory.value}
        });
        products.value = response.data;
    } catch (error) {
        console.log(error)
    }
    loading.value = false;
}

function handlerCategoryChange(category) {
    selectedCategory.value = category;
    fetchProducts()
}

onMounted(fetchProducts)
</script>

<template>
    <g-container>
        <div class="mt-50">
            <g-title-page>Магазин</g-title-page>
        </div>
        <g-categories-menu @categorySelected="handlerCategoryChange"></g-categories-menu>

        <p v-if="loading">Loading...</p>
        <g-products-list :products="products"></g-products-list>
    </g-container>

</template>

<style scoped>
.mt-50 {
    margin-top: 50px;
}
</style>
