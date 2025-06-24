<script setup>
import { nextTick, onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";
import router from "@/router/router.js";
import { useCategoryStore } from "@/stores/categories.js";
import { storeToRefs } from "pinia";
import axios from "axios";

const route = useRoute();

const categoryStore = useCategoryStore();
const { categories } = storeToRefs(categoryStore);

const selectedCategory = ref(0);
const selectedSlug = ref("");
const selectedCategoryName = ref("Все");
const products = ref([]);
const loading = ref(false);

// pagination
const currentPage = ref(Number(route.query.page) || 1);
const lastPage = ref(1);
const perPage = 8;

async function fetchProducts(categoryId = selectedCategory.value) {
    if (loading.value) return;
    loading.value = true;

    try {
        const response = await axios.get(`/api/products`, {
            params: {
                page: currentPage.value,
                per_page: perPage,
                category: categoryId
            },
        });
        products.value = response.data.data;
        lastPage.value = response.data.last_page;
    } catch (error) {
        console.error(error);
    }

    loading.value = false;
}

async function handleCategoryChange(slug) {
    const category = categories.value.find((cat) => cat.slug === slug);

    if (category) {
        selectedCategory.value = category.id;
        selectedSlug.value = category.slug;
        selectedCategoryName.value = category.name;
        document.title = `Магазин - ${category.name}`;
    } else {
        selectedCategory.value = 0;
        selectedSlug.value = "";
        selectedCategoryName.value = "Все";
        document.title = "Магазин - Все товары";
    }

    currentPage.value = 1;

    router.push({
        path: selectedSlug.value ? `/products/${selectedSlug.value}` : '/products',
        query: { page: 1 }
    });

    await nextTick();
    await fetchProducts(category ? category.id : 0);
}


onMounted(async () => {
    if (!categories.value.length) {
        await categoryStore.fetchCategories();
    }
    handleCategoryChange(route.params.category);
});

watch(
    () => route.params.category,
    async (newSlug) => {
        if (!categories.value.length) {
            await categoryStore.fetchCategories();
        }
        handleCategoryChange(newSlug);
    }
);

watch(() => route.query.page, (newPage) => {
    currentPage.value = Number(newPage) || 1;
    fetchProducts();
}, { immediate: true });
</script>

<template>
    <g-container>
        <div class="mt-50">
            <g-title-page>Магазин</g-title-page>
        </div>

        <g-categories-menu />

        <g-breadcrumb
            class="mt-50"
            :selectedSlug="selectedSlug"
            :selectedCategory="selectedCategoryName"
        />

        <g-loader v-if="loading">Loading...</g-loader>
        <g-products-list
            v-else
            class="mt-50"
            :products="products"
        />

        <g-pagination
            :lastPage="lastPage"
            :currentPage="currentPage"
            :selectedSlug="selectedSlug"
        />
    </g-container>
</template>

<style scoped>
.mt-50 {
    margin-top: 50px;
}
</style>
