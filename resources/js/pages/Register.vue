<script setup>

import {ref} from "vue";
import router from "@/router/router.js";
import GButton from "@/components/ui/GButton.vue";

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const errors = ref({});

async function register() {
    try {
        await axios.post('/api/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        });
        router.push('/');
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
}
</script>
<template>
    <div class="form-container">
        <h2>Регистрация</h2>
        <form>
            <div class="form-group">
                <input v-model="name" type="text" placeholder="Имя">
                <div class="error" v-if="errors.name">{{ errors.name[0] }}</div>
            </div>

            <div class="form-group">
                <input v-model="email" class="custom-input" type="email" placeholder="Email">
                <div class="error" v-if="errors.email">{{ errors.email[0] }}</div>
            </div>

            <div class="form-group">
                <input v-model="password" class="custom-input" type="password" placeholder="Пароль">
                <div class="error" v-if="errors.password">{{ errors.password[0] }}</div>
            </div>

            <div class="form-group">
                <input v-model="password_confirmation" class="custom-input" type="password"
                       placeholder="Подтверждение пароля">
                <div class="error" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</div>
            </div>
        </form>

        <g-button class="submit-button" @click="register" type="submit">Зарегистрироваться</g-button>
        <p class="text">У вас уже есть аккаунт? <router-link class="link" :to="{name: 'Login'}">Войти</router-link></p>
    </div>
</template>


<style scoped>

.form-container {
    max-width: 400px;
    margin: 80px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.form-container h2 {
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

.form-group .error-message {
    color: #e63946;
    font-size: 13px;
    margin-top: 6px;
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

.text {
    margin: 6px;
    text-align: center;
    color: gray;
}

.link {
    text-decoration: underline;
}

.link:hover {
    color: #a1a399;
}
</style>






