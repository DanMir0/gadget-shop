<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import GLoader from "@/components/GLoader.vue";

const user = ref(null);
const isAuthResolved = ref(false);

onMounted(async () => {
    try {
        const response = await axios.get('/user')
        user.value = response.data
    } catch (e) {
        user.value = null
    } finally {
        isAuthResolved.value = true
    }
})
</script>

<template>
<div>
    <g-loader v-if="!isAuthResolved"></g-loader>
    <div v-else>
        <g-header :user="user"></g-header>

        <g-main> <slot></slot></g-main>

        <g-footer></g-footer>
    </div>
</div>
</template>

<style scoped>

</style>
