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
            <g-button>Купить</g-button>
        </div>
    </article>
</template>

<style scoped>
.product {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 350px;
    border-radius: 12px;
    gap: 10px;
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

button {
    margin-top: 10px;
    background: #E44D26;
    padding: 10px 15px;
}
</style>

