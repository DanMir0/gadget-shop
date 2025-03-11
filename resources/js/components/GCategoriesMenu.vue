<script setup>
import {onMounted, ref} from "vue";

const emit = defineEmits(['categorySelected'])
const categories = ref([]);

function selectCategory(category) {
    emit('categorySelected', category)
}

async function fetchCategories() {
    try {
        const response = await axios.get(`/api/categories`);
        categories.value = response.data;
        console.log(categories.value)
    } catch (error) {
        console.log(error)
    }
}

onMounted(fetchCategories)
</script>

<template>
<div>
    <nav class="categories">
        <g-button @click="selectCategory(0)" class="link">Все</g-button>
        <g-button v-for="category in categories" :key="category.id" @click="selectCategory(category.id)" class="link">{{ category.name }}</g-button>
    </nav>
</div>
</template>

<style scoped>
.categories {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
}

.link {
    color: #000000;
    border-radius: 0;
    font-size: 17px;
    padding: 19px 65px;
    border: 1px solid;
}
</style>
