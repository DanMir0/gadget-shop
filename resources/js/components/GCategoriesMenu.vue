<script setup>
import {onMounted, ref} from "vue";

const categories = ref([]);


async function fetchCategories() {
    try {
        const response = await axios.get(`/api/categories`);
        categories.value = response.data;
    } catch (error) {
        console.log(error)
    }
}

onMounted(fetchCategories)
</script>

<template>
<div>
    <nav class="categories">
        <router-link to="/products" class="link">Все</router-link>
        <router-link
            v-for="category in categories"
            :key="category.id"
            :to="`/products/${category.slug}`"
            class="link">
            {{ category.name }}
        </router-link>
    </nav>
</div>
</template>

<style scoped>
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
</style>
