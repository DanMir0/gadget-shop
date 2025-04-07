<script setup>

</script>

<template>
    <h3>
       <slot></slot>
    </h3>

</template>

<style scoped>
h3 {
    font-size: 55px;
    font-weight: 500;
}

@media (max-width: 1020px) {
    h3 {
        text-align: center;
    }
}
</style>
