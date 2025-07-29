<script setup>
import {ref} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import axios from 'axios'
import {useI18n} from "vue-i18n";

const route = useRoute()
const router = useRouter()

const token = ref(route.query.token || '')
const email = ref(decodeURIComponent(route.query.email || ''))
const {t} = useI18n()
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
        setTimeout(() => router.push({name: 'Login'}), 2000)
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
            <h2>{{ t('reset_pass.title') }}</h2>

            <input  class="form-group" v-model="email" type="email" readonly/>
            <div class="form-group">
                <input
                    v-model="password"
                    type="password"
                    :placeholder="route.params.lang === 'ru' ? 'Новый пароль' : 'New password'"
                    :class="{
                            'custom-input': true,
                            'error-input': errors.password
                          }"/>
                <div class="error" v-if="errors.password">{{ errors.password[0] }}</div>
            </div>

            <div class="form-group">
                <input
                    v-model="password_confirmation"
                    type="password"
                    :placeholder="route.params.lang === 'ru' ? 'Подтвердите пароль' : 'Confirm password'"
                    :class="{
                            'custom-input': true,
                            'error-input': errors.password_confirmation
                          }"/>
                <div class="error" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</div>
            </div>

            <button @click="resetPassword">{{ t('reset_pass.reset_pass') }}</button>

            <div class="success" v-if="success">{{ t('reset_pass.msg') }}</div>
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

h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 24px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px 14px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

input:focus {
    border-color: #007bff;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.25s ease;
}

button:hover {
    background-color: #0056b3;
}

.error {
    color: #ff0000;
    margin-left: 5px;
}

.error-input {
    border: 1px solid #ff0000 !important;
}

.success {
    color: green;
    margin-top: 10px;
}
</style>
