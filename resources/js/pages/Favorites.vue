<script setup>
import {useAuth} from "@/composoble/useAuth.js";

const {userFavorites} = useAuth();

</script>

<template>
    <g-container>
        <h1>Избранное</h1>
        <div v-for="(item, index) in userFavorites" :key="index">
            <h3 class="category-title">{{item.category}}</h3>
            <g-products-list class="mb-47" :products="item.products"></g-products-list>
        </div>
    </g-container>
</template>

<style scoped>
.mb-47 {
    margin-bottom: 47px;
}

h1 {
    margin-bottom: 21px;
    margin-top: 50px;
}

.category-title {
    color: #838383;
    margin-bottom: 23px;
}
</style>
