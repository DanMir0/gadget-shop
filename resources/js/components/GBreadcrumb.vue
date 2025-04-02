<script setup>
const props = defineProps({selectedCategory: String, selectedSlug: String});
</script>

<template>
    <nav class="breadcrumbs">
        <router-link to="/products" activeClass="active" class="breadcrumb-link center">Магазин</router-link>
        <span v-if="selectedCategory !== 'Все'">
            / <router-link :class="{active: selectedCategory !== 'Все'}" :to="`/products/${selectedSlug}`" class="breadcrumb-link center">
            {{selectedCategory }}
        </router-link>
        </span>
    </nav>
</template>

<style scoped>
.breadcrumbs {
    font-size: 20px;
    display: flex;
    gap: 5px;
}

.breadcrumb-link {
    text-decoration: none;
    position: relative;
    color: #777;
}

.breadcrumb-link:after {
    position: absolute;
    content: '';
    bottom: 0;
    display: block;
    width: 0;
    height: 1px;
    background: #FFA542;
    transition: .3s;
}

.breadcrumb-link.center:after {
    left: 50%;
    transform: translateX(-50%);
}

.breadcrumb-link:hover:after {
    width: 100%;
}

.breadcrumb-link:hover {
    color: #FFA542;
}

.active {
    color: #FFA542;
}
</style>

