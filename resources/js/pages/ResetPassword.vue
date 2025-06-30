<script setup>
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const token = ref(route.query.token || '')
const email = ref(decodeURIComponent(route.query.email || ''))

const password = ref('')
const password_confirmation = ref('')
const errors = ref({})
const success = ref(false)

async function resetPassword() {
    errors.value = {}
    success.value = false

    try {
        await axios.post('/api/reset-password', {
            token: token.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        })

        success.value = true
        setTimeout(() => router.push({ name: 'Login' }), 2000)
    } catch (e) {
        if (e.response?.status === 422) {
            errors.value = e.response.data.errors || {}
        }
    }
}
</script>

<template>
    <div class="wrapper">
        <div class="container">
            <h2>Сброс пароля</h2>

            <input v-model="email" type="email" readonly />

            <input v-model="password" type="password" placeholder="Новый пароль" />
            <div class="error" v-if="errors.password">{{ errors.password[0] }}</div>

            <input v-model="password_confirmation" type="password" placeholder="Подтвердите пароль" />
            <div class="error" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</div>

            <button @click="resetPassword">Сбросить пароль</button>

            <div class="success" v-if="success">Пароль успешно сброшен! Перенаправление...</div>
        </div>
    </div>
</template>

<style scoped>
.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #f1f1f1;
}
.container {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}
input {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
}
button {
    width: 100%;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.error {
    color: red;
    font-size: 14px;
}
.success {
    color: green;
    margin-top: 10px;
}
</style>
