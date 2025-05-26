<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";

const products = ref([]);

onMounted(async () => {
    try {
        const response = await axios.get(`/api/favorites/getProducts`);
        products.value = response.data.data
        console.log(response.data)
    } catch (e) {
        console.error('Ошибка получения избранного', e);
    }
})

</script>

<template>
    <g-container>
            <g-products-list :products="products"></g-products-list>
    </g-container>
</template>

<style scoped>

</style>
