<script setup>

import {useI18n} from "vue-i18n";

defineProps(['products'])

const {t} = useI18n()
</script>

<template>
    <div class="lists">
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
                    <g-button class="btn-edit">Изменить</g-button>
                    <g-button class="btn-del">Удалить</g-button>
                </div>
            </div>
        </article>
    </div>
</template>

<style scoped>
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
