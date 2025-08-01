<script setup>
import {ref} from "vue";
import router from "@/router/router.js";
import {useAuthStore} from "@/stores/auth.js";
import {useCartStore} from "@/stores/cart.js";
import {useI18n} from "vue-i18n";
import {useRoute} from "vue-router";

const email = ref("");
const password = ref("");
const errors = ref({});
const {t} = useI18n()
const auth = useAuthStore()
const cart = useCartStore()
const route = useRoute()

async function clickLogin() {
    try {
        await axios.get('/sanctum/csrf-cookie') // <- важно!
        await auth.login(email.value, password.value)
        await cart.loadCart()
        router.push('/')
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors
        } else {
            console.error('Ошибка при логине', error)
        }
    }

}
</script>

<template>
    <div class="wrapper">
        <div class="form-container">
            <h2>{{ t('login.title') }}</h2>
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
                    <input v-model="password"
                           class="{
                            'custom-input': true,
                            'error-input': errors.email
                          }"
                           type="password"
                           :placeholder="route.params.lang === 'ru' ? 'Пароль' : 'Password' ">
                    <div class="error" v-if="errors.password">{{ errors.password[0] }}</div>
                </div>
            </form>

            <g-button class="submit-button" @click="clickLogin" type="submit">{{ t('login.sign_in') }}</g-button>
            <div class="links">
                <router-link class="link" :to="{name: 'Register'}">{{ t('login.sign_up') }}</router-link>
                <router-link class="link" :to="{name: 'ForgotPassword'}">{{ t('login.forgot_pass') }}</router-link>
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
