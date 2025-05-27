<script setup>
import {useAuth} from "@/composoble/useAuth.js";

const {user, isAuthResolved} = useAuth();
</script>

<template>
<div>
    <g-loader v-if="!isAuthResolved"></g-loader>
    <div v-else>
        <g-header :isAuthResolved="isAuthResolved"></g-header>

        <g-main> <slot></slot></g-main>

        <g-footer></g-footer>
    </div>
</div>
</template>

<style scoped>

</style>
