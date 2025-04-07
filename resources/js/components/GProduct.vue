<script setup>
import GButton from "@/components/ui/GButton.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    }
});


</script>

<template>
    <article class="product">
        <img class="product-image" :src="product.image" :alt="product.name">
        <div class="product-info">
            <div class="product-title">
                <p class="text product-name">{{ product.name }}</p>
                <p class="text product-price">{{ product.price.toLocaleString() }} ₽</p>
            </div>
            <div>
                <p class="product-description">{{ product.description }}</p>
            </div>
            <div class="product-block-stock">
                <p class="product-stock">Осталось: <strong>{{ product.stock }}</strong></p>
            </div>
            <g-button class="buy-button">Купить</g-button>
        </div>
    </article>
</template>

<style scoped>
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
    width: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.product-stock {
    color: #444;
}

.product-block-stock {
    text-align: center;
}

.buy-button {
    margin-top: 10px;
    background: #E44D26; /* Цвет кнопки */
    color: #fff; /* Цвет текста на кнопке */
    border: none; /* Убираем границу */
    border-radius: 6px; /* Округление углов кнопки */
    padding: 10px 15px; /* Отступы */
    cursor: pointer; /* Указатель при наведении */
    transition: background-color 0.3s; /* Плавный переход цвета фона */
}

.buy-button:hover {
    background-color: #FFA542; /* Цвет кнопки при наведении */
}

@media (max-width: 768px) {
    .product {
        padding: 14px;
        min-height: auto;
    }

}
</style>

