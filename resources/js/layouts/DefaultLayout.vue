<script setup>
import {useAuthStore} from "@/stores/auth.js";

const auth = useAuthStore();
</script>

<template>
<div class="layout">
    <g-loader v-if="!auth.isAuthResolved"></g-loader>
    <div v-else class="layout-inner">
        <g-header :isAuthResolved="auth.isAuthResolved"></g-header>

        <g-main class="main-content"> <slot></slot></g-main>

        <g-footer class="footer"></g-footer>
    </div>
</div>
</template>

<style scoped>
.layout {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.layout-inner {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.main-content {
    flex: 1;
}

.footer {
    margin-top: auto;
}
</style>
