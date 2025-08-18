<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import GButton from "@/components/ui/GButton.vue";

const categories = ref([])

async function fetchCategories() {
    try {
        const response = await axios.get(`/api/get-categories/`);
        categories.value = response.data;
    } catch (e) {

    }
}

onMounted(async () => {
    await fetchCategories()
})
</script>

<template>
    <g-admin-menu :to="{name: 'AddCategory'}">категорию</g-admin-menu>
    <div class="category">
        <ul class="category-lists">
            <li class="category-item" v-for="item in categories" :key="item.id">
                <h3>{{ item.name }}</h3>
                <div class="group-btn">
                    <g-button class="btn-edit" size="sm">Изменить</g-button>
                    <g-button class="btn-del" size="sm">Удалить</g-button>
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.category {
    margin-top: 30px;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 12px;
}

.category-lists {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.category-item {
    padding: 16px 20px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    background-color: #fff;
    align-items: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.category-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
    color: #333;
}

.group-btn {
    display: flex;
    gap: 10px;
}

.btn-del {
    background-color: #D20505;
    color: white;
}

.btn-edit {
    background-color: #007bff;
    color: #fff;
}
</style>
