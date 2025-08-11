<script setup>
import {onMounted, ref} from "vue";
import {useLangStore} from "@/stores/lang.js";
import axios from "axios";
import { useRoute } from 'vue-router';

const route = useRoute();
const products = ref([]);
const langStore = useLangStore();
const perPage = 8;
const currentPage = ref(Number(route.query.page) || 1);
const loading =  ref(false);
const lastPage = ref(1);

async function fetchProductsAdmin() {
    if (loading.value) return;
    loading.value = true;

    try {
        const response = await axios.get(`/api/admin/products`, {
            params: {
                page: currentPage.value,
                per_page: perPage,
                lang: langStore.currentLang
            }
        })
        products.value = response.data.data
    } catch (e) {

    }
    loading.value = false;
}

onMounted(async () => {
    await fetchProductsAdmin();
});
</script>

<template>
        <g-admin-products-list class="mt-30" :products="products"></g-admin-products-list>
</template>

<style scoped>
    .mt-30 {
        margin-top: 30px;
    }
</style>
