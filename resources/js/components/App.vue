<script setup>
import {onMounted, watch} from 'vue'
import {useAuthStore} from "@/stores/auth.js";
import {useRoute} from "vue-router";
import {useI18n} from "vue-i18n";
import {useCartStore} from "@/stores/cart.js";


const {locale} = useI18n()
const cart = useCartStore()
const authStore = useAuthStore()
const route = useRoute()

onMounted(() => {
    authStore.fetchUser()
})

watch(() => route.params.lang, (lang) => {
    locale.value = lang;
    if (authStore.fetchUser()) {
        cart.loadCart(lang)
    }
}, { immediate: true})
</script>
<template>
   <router-view></router-view>
</template>
