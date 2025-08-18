<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import {useRoute} from "vue-router";
import router from "@/router/router.js";

const route = useRoute()
const category = ref({
    name: '',
    slug: '',
})

async function getCategory() {
    const response = await axios.get(`/api/get-category/${route.params.id}`)
    category.value = response.data
}

async function saveCategory() {
    const formatData = new FormData()
    formatData.append('name', category.value.name)
    formatData.append('slug', category.value.slug)
    formatData.append('_method', 'PUT')
    try {
        await axios.post(`/admin/category/${route.params.id}`, formatData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        alert('Товар успешно обновлен')
        router.push({name: 'AdminCategory'})
    } catch (e) {

    }
}

onMounted(async () => {
    await getCategory()
})
</script>

<template>
    <div class="form-container" @submit.prevent="saveCategory()">
        <h2>Редактирование категории</h2>
        <form id="edit-product-form" >

            <label for="name_ru">Название</label>
            <input type="text" id="name" v-model="category.name">

            <label for="name_en">Slug</label>
            <input type="text" id="slug" v-model="category.slug">

            <div class="form-actions">
                <g-button type="submit">Сохранить</g-button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
