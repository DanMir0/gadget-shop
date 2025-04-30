<script setup>
import {ref} from "vue";
import router from "@/router/router.js";

const email = ref("");
const password = ref("");
const errors = ref({});

async function login() {
    errors.value = {}
    try {
        await axios.post('/api/login', {
            email: email.value,
            password: password.value,
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
    <div class="wrapper">
        <div class="form-container">
            <h2>Авторизация</h2>
            <form>
                <div class="form-group">
                    <input
                        v-model="email"
                        :class="{
                            'custom-input': true,
                            'error-input': errors.email
                          }"
                        type="email"
                        placeholder="Email"
                    />
                    <div class="error" v-if="errors.email">{{ errors.email[0] }}</div>
                </div>

                <div class="form-group">
                    <input v-model="password" :
                           class="{
                            'custom-input': true,
                            'error-input': errors.email
                          }"
                           type="password"
                           placeholder="Пароль">
                    <div class="error" v-if="errors.password">{{ errors.password[0] }}</div>
                </div>
            </form>

            <g-button class="submit-button" @click="login" type="submit">Войти</g-button>
            <div class="links">
                <router-link class="link" :to="{name: 'Register'}">Зарегистрироваться</router-link>
                <router-link class="link" :to="{name: ''}">Забыли пароль?</router-link>
            </div>
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

.form-container {
    width: 100%;
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


.links {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
}

.links a {
    text-decoration: none;
    color: gray;
}

.links a:hover {
    text-decoration: underline;
}

.error-input {
    border: 1px solid #ff0000 !important;
}
</style>
