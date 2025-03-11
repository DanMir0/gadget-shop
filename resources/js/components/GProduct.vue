<script setup>
const props = defineProps({
    product: {
        type: Object,
        required: true,
    }
});


</script>

<template>
    <article class="product">
        <img :src="product.image" :alt="product.name">
        <div>
            <h2>{{ product.name }}</h2>
            <h2>{{ product.price }}</h2>
        </div>
        <div>
            <p>{{ product.description }}</p>
        </div>
        <div><p>Осталось: {{ product.stock }}</p></div>
    </article>
</template>

<style scoped>
img {
    width: 320px;
    height: 320px;
}
</style>
