<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import GButton from "@/components/ui/GButton.vue";
import router from "@/router/router.js";
import {useLangStore} from "@/stores/lang.js";

const categories = ref([])
const lang = useLangStore()
const showModal = ref(false)
const selectedCategory = ref(null)
async function fetchCategories() {
    try {
        const response = await axios.get(`/api/get-categories/`);
        categories.value = response.data;
    } catch (e) {

    }
}

function goToEdit(id) {
    router.push({name: 'EditCategory', params: {id: id, lang: lang.currentLang}})
}

function openModal(category) {
    showModal.value = true
    selectedCategory.value = category
}

async function confirmDelete(categoryId) {
    await axios.delete(`/admin/category/${categoryId}`)
    showModal.value = false
    selectedCategory.value = null
    categories.value = categories.value.filter(c => c.id != categoryId)
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
                    <g-button @click="goToEdit(item.id)" class="btn-edit" size="sm">Изменить</g-button>
                    <g-button @click="openModal(item)" class="btn-del" size="sm">Удалить</g-button>
                </div>
            </li>
        </ul>
    </div>

    <div v-if="showModal" class="modal-overlay">
        <div class="modal">
            <h3>Подтверждение</h3>
            <p>Вы уверены, что хотите удалить категорию
                <strong>{{ selectedCategory?.name }}</strong>?</p>
            <div class="modal-actions">
                <g-button @click="confirmDelete(selectedCategory.id)" class="btn-del">Удалить</g-button>
                <g-button @click="showModal = false" class="btn-cancel">Отмена</g-button>
            </div>
        </div>
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

.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal {
    background: white;
    padding: 20px;
    border-radius: 10px;
    max-width: 400px;
    width: 90%;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}

.modal-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-cancel {
    background-color: #777;
    color: #fff;
}
</style>
