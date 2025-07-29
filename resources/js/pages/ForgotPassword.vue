<script setup>
import GButton from "@/components/ui/GButton.vue";
import {ref} from "vue";
import axios from "axios";
import {useI18n} from "vue-i18n";
import {useRoute} from "vue-router";

const email = ref('')
const success = ref('')
const errors = ref({})
const {t} = useI18n()
const route = useRoute()
async function forgotPassword() {
    errors.value = {}
    success.value = ''

    try {
        await axios.post('/api/forgot-password', {email: email.value, lang: route.params.lang})
        success.value = route.params.lang === 'ru' ? 'Письмо с инструкциями отправлено на почту.' : 'A letter with instructions has been sent to the post office.'
    } catch (e) {
        if (e.response.status === 422) {
            errors.value = e.response.data || {message: e.response.data.message}
        }
    }
}
</script>

<template>
    <div class="wrapper">
        <div class="container">
            <h2>{{ t('forgot_pass.title')}}</h2>
            <div class="form-group">
                <input
                    v-model="email"
                    :class="{
                            'custom-input': true,
                            'error-input': errors.email
                          }"
                    type="email"
                    :placeholder="route.params.lang === 'ru' ? 'Введите Email' : 'Enter Email'">
                <div v-if="errors.email || errors.message" class="error">
                    {{ errors.email?.[0] || errors.message }}
                </div>
            </div>
            <g-button class="submit-button" @click="forgotPassword">{{ t('forgot_pass.send_link') }}</g-button>
            <div v-if="success" class="success">{{ success }}</div>
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

.form-group input {
    width: 100%;
    padding: 10px 14px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #007bff;
    outline: none;
}

.submit-button {
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

.submit-button:hover {
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
