<script setup>
import {onMounted, ref, watch} from "vue";
import {useRoute, useRouter} from "vue-router";

// pagination
const router = useRouter();


const route = useRoute();
const selectedCategory = ref(0);
const selectedSlug = ref("")
const selectedCategoryName = ref("Все");
const products = ref([]);
const loading = ref(false);
const categories = ref([]);

// pagination
const currentPage = ref(Number(route.query.page) || 1);
const lastPage = ref(1);
const perPage = 5;

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
// pagination
function changePage(page) {
    if (page >= 1 && page <= lastPage.value) {
        router.push({
            query: {
                page,
                category: selectedSlug.value || undefined // ✅ Учитываем категорию
            }
        });
    }
}
// pagination
watch(() => route.query.page, (newPage) => {
    currentPage.value = Number(newPage) || 1;
    fetchProducts();
}, {immediate: true});

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

        //
        currentPage.value = 1; // ✅ Сброс страницы при смене категории
        router.push({ query: { page: 1, category: selectedSlug.value || undefined } }); // ✅ Обновляем URL


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

        <g-breadcrumb class="mt-50" :selectedSlug="selectedSlug"
                      :selectedCategory="selectedCategoryName"></g-breadcrumb>

        <g-loader v-if="loading">Loading...</g-loader>
        <g-products-list v-else class="mt-50" :products="products"></g-products-list>
        <!-- Пагинация -->
        <div class="pagination" v-if="lastPage > 1">
            <button
                @click="changePage(currentPage - 1)"
                :disabled="currentPage === 1"
                class="pagination-button">
                Назад
            </button>

            <button
                v-for="page in lastPage"
                :key="page"
                @click="changePage(page)"
                class="pagination-button"
                :class="{ active: currentPage === page }">
                {{ page }}
            </button>

            <button
                @click="changePage(currentPage + 1)"
                :disabled="currentPage === lastPage"
                class="pagination-button">
                Вперед
            </button>
        </div>
    </g-container>

</template>

<style scoped>
.mt-50 {
    margin-top: 50px;
}

.pagination {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 30px;
}

.pagination-button {
    padding: 10px 16px;
    font-size: 16px;
    border-radius: 8px;
    border: 2px solid #000;
    background-color: #fff;
    color: #000;
    cursor: pointer;
    transition: all 0.2s ease;
}

.pagination-button:hover:not(:disabled) {
    background-color: #000;
    border-color: #000;
    color: #fff;
}

.pagination-button.active {
    background-color: #000;
    color: #fff;
    border-color: #000;
}

.pagination-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
