<script setup>
import {useI18n} from "vue-i18n";
import {useLangStore} from "@/stores/lang.js";
import router from "@/router/router.js";
import GButton from "@/components/ui/GButton.vue";
import {ref} from "vue";
import axios from "axios";

defineProps(['products'])
const emit = defineEmits(['product-delete'])
const lang = useLangStore()
const {t} = useI18n()
const selectedProduct = ref(null)
const showModal = ref(false)


function goToEdit(productId) {
    router.push({name: 'EditProduct', params: {id: productId}, lang: lang.currentLang})
}

function openModal(product) {
    showModal.value = true;
    selectedProduct.value = product
}

async function confirmDelete(productId) {
    await axios.delete(`/admin/products/${productId}`)
    showModal.value = false;
    selectedProduct.value = null
    emit('product-delete', productId)
}

</script>

<template>
    <div class="lists mt-30">
        <article class="product" v-for="(item, index) in products" :key="index">
            <div class="image-wrapper">
                <img class="product-image" :src="item.image" :alt="item.name">
            </div>
            <div class="product-info">
                <div class="product-title">
                    <p class="text product-name">{{ item.name }}</p>
                    <p class="text product-price">{{ item.price.toLocaleString() }} ₽</p>
                </div>
                <div>
                    <p class="product-description">{{ item.description }}</p>
                </div>
                <div class="product-block-stock">
                    <p class="product-stock">{{ t('products.stock') }} <strong>{{ item.stock }}</strong></p>
                </div>
                <div class="product-group-btn">
                    <g-button @click="goToEdit(item.id)" class="btn-edit">Изменить</g-button>
                    <g-button @click="openModal(item)" class="btn-del">Удалить</g-button>
                </div>
            </div>
        </article>
    </div>

    <div v-if="showModal" class="modal-overlay">
        <div class="modal">
            <h3>Подтверждение</h3>
            <p>Вы уверены, что хотите удалить товар
                <strong>{{ selectedProduct?.name }}</strong>?</p>
            <div class="modal-actions">
                <g-button @click="confirmDelete(selectedProduct.id)" class="btn-del">Удалить</g-button>
                <g-button @click="showModal = false" class="btn-cancel">Отмена</g-button>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* модалка */
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

.mt-30 {
    margin-top: 30px;
}

.lists {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-content: center;
}

.btn-del {
    background-color: #D20505;
    color: white;
}

.btn-edit {
    background-color: #007bff;
    color: #fff;
}

.product-group-btn {
    display: flex;
    gap: 5px;
    justify-content: space-between;
}

@media (max-width: 500px) {
    .lists {
        grid-template-columns: 1fr;
        gap: 15px;
        padding: 0 10px 30px;
        align-items: center;
    }
}

.image-wrapper {
    position: relative;
    width: 100%;
}

.product {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    background-color: #fff; /* Белый фон */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Увеличенная тень */
    padding: 20px;
    max-width: 350px;
    border-radius: 12px;
    gap: 10px;
    transition: transform 0.2s; /* Плавный эффект при наведении */
    min-height: 500px;
}

.product:hover {
    transform: translateY(-5px); /* Подъем при наведении */
}

.product-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 5px;
}

.product-info {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 10px;
}

.text {
    font-size: 18px;
    font-weight: 600;
}

.product-name {
    max-width: 170px;
    overflow: hidden; /* Предотвращение переполнения текста */
    white-space: nowrap; /* Однострочный текст */
    text-overflow: ellipsis;
}

.product-price {
    color: #FFA542;
}

.product-description {
    color: #777;
}

.product-image {
    display: block;
    width: 100%;
    height: 264px; /* одинаковая высота для всех карточек */
    object-fit: contain; /* сохраняет пропорции, не обрезает */
    object-position: center; /* по центру */
    border-radius: 10px;
    background-color: #f8f8f8; /* светлый фон, если изображение меньше */
    padding: 10px; /* отступы внутри, если нужно */
}

.product-stock {
    color: #444;
}

.product-block-stock {
    text-align: center;
}

@media (max-width: 768px) {
    .product {
        padding: 14px;
        min-height: auto;
    }
}
</style>
