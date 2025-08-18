<script setup>
import {ref} from "vue";
import axios from "axios";
import router from "@/router/router.js";

const category = ref({
    name: '',
    slug: '',
})

async function saveCategory() {
    const formData = new FormData()
    formData.append('name', category.value.name)
    formData.append('slug', category.value.slug)
    try {
        const response = await axios.post(`/admin/category`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        router.push({name: 'AdminCategory'})
    } catch (e) {

    }
}
</script>

<template>
    <div class="form-container" @submit.prevent="saveCategory()">
        <h2>Редактирование товара</h2>
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
