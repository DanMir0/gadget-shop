import { ref } from 'vue'
import axios from 'axios'

const user = ref(null)
const isAuthenticated = ref(false)
const isAuthResolved = ref(false)
const loading = ref(false)

export function useAuth() {
    // Загрузка данных пользователя
    async function initAuth() {
        loading.value = true
        try {
            const response = await axios.get('/user')
            user.value = response.data
            isAuthenticated.value = !!user.value?.id
        } catch (e) {
            user.value = null
            isAuthenticated.value = false
        } finally {
            isAuthResolved.value = true
            loading.value = false
        }
    }

    // Вход пользователя
    async function login(email, password) {
        try {
            const response = await axios.post('/api/login', { email, password })
            user.value = response.data.user
            isAuthenticated.value = true
            return response
        } catch (e) {
            throw e
        }
    }

    // Регистрация пользователя
    async function register(data) {
        try {
            const response = await axios.post('/register', data)
            user.value = response.data.user
            isAuthenticated.value = true
            return response
        } catch (e) {
            throw e
        }
    }

    // Выход пользователя
    async function logout() {
        try {
            await axios.post('/logout')
        } finally {
            user.value = null
            isAuthenticated.value = false
        }
    }

    // Обновить данные пользователя вручную
    async function refreshUser() {
        try {
            const response = await axios.get('/user')
            user.value = response.data
            isAuthenticated.value = !!user.value?.id
        } catch (e) {
            user.value = null
            isAuthenticated.value = false
        }
    }

    return {
        user,
        isAuthenticated,
        isAuthResolved,
        loading,
        login,
        register,
        logout,
        refreshUser,
        initAuth,
    }
}
