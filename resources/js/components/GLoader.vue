<script setup>

</script>

<template>
    <div class="loader-container">
        <div class="spinner"></div>
    </div>
</template>

<style scoped>
.loader-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    position: fixed;
    top: 46%;
    left: 46%;
}

.spinner {
    width: 100px;
    height: 100px;
    border: 5px solid rgba(0, 0, 0, 0.1);
    border-left-color: #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
