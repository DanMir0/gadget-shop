<script setup>
import {onMounted, ref, watch} from "vue";
import router from "@/router/router.js";

const categories = ref([]);

const selected = ref("Все");

async function fetchCategories() {
    try {
        const response = await axios.get(`/api/categories`);
        categories.value = response.data;
    } catch (error) {
        console.log(error)
    }
}

watch(selected, (newVal) => {
    if (newVal === "Все") {
        router.push("/products")
    } else {
        router.push(`/products/${newVal}`)
    }
})

onMounted(fetchCategories)
</script>

<template>
    <nav class="categories">
        <router-link to="/products" exact-active-class="active" class="link">Все</router-link>
        <router-link
            exact-active-class="active"
            v-for="category in categories"
            :key="category.id"
            :to="`/products/${category.slug}`"
            class="link">
            {{ category.name }}
        </router-link>
    </nav>

    <!--    мобильное меню-->
    <div class="categories-mobile">
        <select v-model="selected" class="categories-mobile-selected">
            <option>Все</option>
            <option v-for="category in categories"
                    :key="category.id"
                    :value="category.slug">
                {{ category.name }}
            </option>
        </select>
    </div>

</template>

<style scoped>
.active {
    background-color: #f4f4f4;
}

.categories {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.link {
    color: #000;
    font-size: 17px;
    padding: 19px 61px;
    border: 1px solid black;
    text-decoration: none;
}

.link:hover {
    background: #f4f4f4;
}

.categories-mobile {
    display: flex;
    justify-content: center;
}

.categories-mobile-selected {
    padding: 12px 20px;
    font-size: 16px;
    color: #000000;
    background-color: #ffffff;
    border: 2px solid #cccccc;
    border-radius: 8px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg viewBox='0 0 140 140' width='12' height='12' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='20 50 70 100 120 50' stroke='%23000' stroke-width='15' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    max-width: 320px;
}

.categories-mobile-selected:focus {
    outline: none;
    border-color: #000; /* При фокусе становится более чёткой */
}

.categories-mobile-selected:hover {
    border-color: #999;
    background-color: #f9f9f9;
}

@media (min-width: 768px) {
    .categories-mobile {
        display: none;
    }
}

@media (max-width: 767px) {
    .categories {
        display: none;
    }
}

@media (max-width: 1260px) {
    .categories {
        justify-content: center;
        flex-wrap: wrap;
    }
}
</style>
