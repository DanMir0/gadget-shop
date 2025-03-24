<script setup>
import {onMounted, ref, watch} from "vue";
import GBreadcrumb from "@/components/GBreadcrumb.vue";
import {useRoute} from "vue-router";
import GLoader from "@/components/GLoader.vue";

const route = useRoute();
const selectedCategory = ref(0);
const selectedSlug = ref("")
const selectedCategoryName = ref("Все");
const products = ref([]);
const loading = ref(false);
const categories = ref([]);

async function fetchCategories() {
    try {
        const response = await axios.get(`/api/categories`);
        categories.value = response.data;
    } catch (error) {
        console.error("Ошибка загрузки категорий", error);
    }
}

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

watch(
    () => route.params.category,
    (slug) => {
        if (!slug) {
            document.title = "Магазин - Все товары";
            selectedCategory.value = 0;
            selectedCategoryName.value = "Все";
        } else {
            const category = categories.value.find(cat => cat.slug === slug);
            if (category) {
                document.title = `Магазин - ${category.name}`;
                selectedSlug.value = category.slug;
                selectedCategory.value = category.id;
                selectedCategoryName.value = category.name;
            } else {
                document.title = "Магазин";
                selectedCategory.value = 0;
                selectedCategoryName.value = "Все";
            }
        }
        fetchProducts()
    },
    {immediate: true}
);

onMounted(async () => {
    await fetchCategories();
    await fetchProducts();
})
</script>

<template>
    <g-container>
        <div class="mt-50">
            <g-title-page>Магазин</g-title-page>
        </div>
        <g-categories-menu></g-categories-menu>

        <g-breadcrumb class="mt-50" :selectedSlug="selectedSlug" :selectedCategory="selectedCategoryName"></g-breadcrumb>

        <g-loader v-if="loading">Loading...</g-loader>
        <g-products-list v-else class="mt-50" :products="products"></g-products-list>
    </g-container>

</template>

<style scoped>
.mt-50 {
    margin-top: 50px;
}
</style>
