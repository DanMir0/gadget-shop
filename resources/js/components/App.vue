<script setup>
import { onMounted } from 'vue'
import {useAuthStore} from "@/stores/auth.js";

const authStore = useAuthStore()

onMounted(() => {
    authStore.fetchUser()
})
</script>
<template>
   <router-view></router-view>
</template>
