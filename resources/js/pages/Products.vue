<script setup>
import {onMounted, ref, watch} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useCategories} from "../composoble/useCategories.js";

// pagination
const router = useRouter();

const { categories } = useCategories();

const route = useRoute();
const selectedCategory = ref(0);
const selectedSlug = ref("")
const selectedCategoryName = ref("Все");
const products = ref([]);
const loading = ref(false);

// pagination
const currentPage = ref(Number(route.query.page) || 1);
const lastPage = ref(1);
const perPage = 8;

async function fetchProducts() {
    if (loading.value) return
    loading.value = true;
    try {
        const response = await axios.get(`/api/products`, {
            params: {
                // pagination
                page: currentPage.value,
                per_page: perPage,
                category: selectedCategory.value,
            }
        });
        products.value = response.data.data;
        lastPage.value = response.data.last_page;
    } catch (error) {
        console.log(error)
    }
    loading.value = false;
}

function handleCategoryChange(slug) {
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

    currentPage.value = 1; // ✅ Сброс страницы при смене категории
    router.push({ query: { page: 1, category: selectedSlug.value || undefined } }); // ✅ Обновляем URL

    fetchProducts()
}

// pagination
watch(() => route.query.page, (newPage) => {
    currentPage.value = Number(newPage) || 1;
    fetchProducts();
}, {immediate: true});

watch(
    () => route.params.category,
    (slug) => {
        if (categories.value.length > 0) {
            handleCategoryChange(slug);
        }
    },
);
onMounted(async () => {
    // Вручную вызываем обработку категории, чтобы правильно задать хлебные крошки
    const slug = route.params.category;
    handleCategoryChange(slug);
});
</script>

<template>
    <g-container>
        <div class="mt-50">
            <g-title-page>Магазин</g-title-page>
        </div>
        <g-categories-menu></g-categories-menu>

        <g-breadcrumb class="mt-50" :selectedSlug="selectedSlug"
                      :selectedCategory="selectedCategoryName"></g-breadcrumb>

        <g-loader v-if="loading">Loading...</g-loader>
        <g-products-list v-else class="mt-50" :products="products"></g-products-list>

        <!-- Пагинация -->
        <g-pagination :lastPage="lastPage" :currentPage="currentPage" :selectedSlug="selectedSlug"></g-pagination>
    </g-container>

</template>

<style scoped>
.mt-50 {
    margin-top: 50px;
}
</style>
