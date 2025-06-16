<script setup>
import {onMounted, ref, watch} from "vue";
import {useRoute} from "vue-router";
import GPagination from "@/components/GPagination.vue";

const loading = ref(false)
const products = ref([]);
const currentPage = ref(1);
const lastPage = ref(1);
const route = useRoute();

async function fetchNewProducts(page = 1) {
    loading.value = true
    try {
        const response = await axios.get("/api/new-products", {
            params: {page}
        });
        products.value = response.data

        products.value = response.data.data; // Только .data
        currentPage.value = response.data.current_page;
        lastPage.value = response.data.last_page;
    } catch (e) {
        console.error(e)
    } finally {
        loading.value = false;
    }
}

onMounted(async () => {
    currentPage.value = Number(route.query.page) || 1;
    await fetchNewProducts(currentPage.value)
})

watch(() => route.query.page, (newPage) => {
    currentPage.value = Number(newPage) || 1;
    fetchNewProducts(currentPage.value);
});
</script>

<template>
    <g-title-page class="title">Новые товары</g-title-page>
    <g-loader v-if="loading">Loading...</g-loader>
    <g-products-list v-else :products="products"></g-products-list>
    <g-pagination class="mb-120" :lastPage="lastPage" :currentPage="currentPage"></g-pagination>
</template>

<style scoped>
.mb-120 {
    margin-bottom: 120px;
}

.title {
    margin-top: 50px;
    margin-bottom: 20px;
}
</style>
