<script setup>
import { onMounted } from 'vue'
import { useAuth } from '../composoble/useAuth.js'

const auth = useAuth()

onMounted(() => {auth.initAuth()
})
</script>
<template>
   <router-view></router-view>
</template>
