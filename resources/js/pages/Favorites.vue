<script setup>
import {useAuth} from "@/composoble/useAuth.js";

const {userFavorites} = useAuth();
console.log(userFavorites)
</script>

<template>
    <g-container>
            <g-products-list :products="userFavorites.data"></g-products-list>
    </g-container>
</template>

<style scoped>

</style>
