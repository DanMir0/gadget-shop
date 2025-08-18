<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import router from "@/router/router.js";

const product = ref({
    name: { ru: '', en: '' },
    description: { ru: '', en: '' },
    price: null,
    stock: null,
    image: null,
    category_id: null,
    status_id: null
})
const categories =ref([]);
const statuses =ref([]);
const imagePreview = ref(null)

function onImageChange(e) {
    const file = e.target.files[0]
    if (file) {
        imagePreview.value = URL.createObjectURL(file)
        product.value.image = file
    }
}

async function fetchCategories() {
    try {
        const response = await axios.get(`/api/get-categories/`);
        categories.value = response.data;
    } catch (e) {

    }
}

async function fetchStatuses() {
    try {
        const response = await axios.get(`/api/get-statuses/`);
        statuses.value = response.data;
    } catch (e) {

    }
}

async function saveProduct() {
    const formData = new FormData()
    formData.append('name[ru]', product.value.name.ru)
    formData.append('name[en]', product.value.name.en)
    formData.append('description[ru]', product.value.description.ru || '')
    formData.append('description[en]', product.value.description.en || '')
    formData.append('price', product.value.price)
    formData.append('stock', product.value.stock)
    formData.append('category_id', product.value.category_id)
    formData.append('status_id', product.value.status_id)
    if (product.value.image instanceof File) {
        formData.append('image', product.value.image)
    }
    formData.append('_method', 'POST')
    try {
        await axios.post(`/admin/products`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        router.push({name: 'AdminProduct'})
    } catch (error) {
        console.error(error.response?.data || error.message)
    }
}


onMounted( async () => {
    await fetchCategories()
    await fetchStatuses()
})
</script>

<template>
    <div class="form-container" @submit.prevent="saveProduct()">
        <h2>Добавление товара</h2>
        <form id="edit-product-form" >

            <label for="name_ru">Название (RU)</label>
            <input type="text" id="name_ru" v-model="product.name.ru">

            <label for="name_en">Название (EN)</label>
            <input type="text" id="name_en" v-model="product.name.en">

            <label for="description_ru">Описание (RU)</label>
            <textarea id="description_ru" v-model="product.description.ru"></textarea>

            <label for="description_en">Описание (EN)</label>
            <textarea id="description_en" v-model="product.description.en"></textarea>

            <label for="price">Цена (₽)</label>
            <input type="number" id="price" v-model="product.price" step="0.01">

            <label for="stock">Количество на складе</label>
            <input type="number" id="stock" v-model="product.stock" min="0">

            <label for="image">Изображение</label>
            <input type="file" id="image" @change="onImageChange" accept="image/*">
            <div v-if="imagePreview" class="image-preview">
                <img :src="imagePreview" alt="Предпросмотр" />
            </div>

            <label for="category">Категория</label>
            <select id="category" v-model="product.category_id">
                <option disabled value="">Выберите категорию</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>

            <label for="status">Статус товара</label>
            <select id="status" v-model="product.status_id">
                <option disabled value="">Выберите статус</option>
                <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.name }}</option>
            </select>

            <div class="form-actions">
                <g-button type="submit">Сохранить</g-button>
            </div>
        </form>
    </div>
</template>

<style scoped>
.form-container {
    max-width: 700px;
    margin: 30px auto;
    background: #fff;
    padding: 20px 25px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    margin-bottom: 20px;
}
label {
    display: block;
    margin: 12px 0 6px;
    font-weight: bold;
}
input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    background: #fff;
    box-sizing: border-box;
}
textarea {
    resize: vertical;
    min-height: 80px;
}
.image-preview {
    margin-top: 10px;
}
.image-preview img {
    max-width: 150px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
.form-actions {
    text-align: center;
    margin-top: 20px;
}
.form-actions button {
    padding: 10px 20px;
    border: none;
    background: #007bff;
    color: white;
    font-size: 15px;
    border-radius: 6px;
    cursor: pointer;
}
.form-actions button:hover {
    background: #0056b3;
}

</style>
