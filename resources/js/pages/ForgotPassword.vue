<script setup>
import GButton from "@/components/ui/GButton.vue";
import {ref} from "vue";
import axios from "axios";

const email = ref('')
const success = ref('')
const errors = ref({})

async function forgotPassword() {
    errors.value = {}
    success.value = ''

    try {
        await axios.post('/api/forgot-password', {email: email.value})
        success.value = 'Письмо с инструкциями отправлено на почту.'
    } catch (e) {
        if (e.response.status === 422) {
            errors.value = e.response.data
        }
    }
}
</script>

<template>
    <div class="wrapper">
        <div class="container">
            <h2>Забыли пароль?</h2>
            <input v-model="email" type="email" placeholder="Введите Email">
            <div v-if="errors.email" class="error">{{ errors.email[0] }}</div>
            <g-button @click="forgotPassword">Отправить ссылку</g-button>
            <div v-if="success" class="succes">{{ success }}</div>
        </div>

    </div>
</template>

<style scoped>
.wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f1f1f1;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 400px;
    margin: 80px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}
</style>
