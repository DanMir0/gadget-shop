<script setup>
import {useAuth} from "@/composoble/useAuth.js";

const {isAuthResolved} = useAuth();
</script>

<template>
<div class="layout">
    <g-loader v-if="!isAuthResolved"></g-loader>
    <div v-else class="layout-inner">
        <g-header :isAuthResolved="isAuthResolved"></g-header>

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
