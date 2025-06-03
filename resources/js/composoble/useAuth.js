import { ref, onMounted } from 'vue'
import axios from 'axios'

const user = ref(null)
const isAuthenticated = ref(false)
const isAuthResolved = ref(false)
const userFavorites = ref([])
const loading = ref(false)

export function useAuth() {
    // Загрузка данных пользователя
    async function initAuth() {
        loading.value = true
        try {
            const response = await axios.get('/user')
            user.value = response.data
            isAuthenticated.value = !!user.value?.id

            if (isAuthenticated.value) {
                const favoritesResponse = await axios.get('/api/product-categories')
                userFavorites.value = favoritesResponse.data
            }
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
            const response = await axios.post('/api/login', {email: email, password: password})
            user.value = response.data.user
            isAuthenticated.value = true
            await fetchCategoriesFavorites()
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
            await fetchCategoriesFavorites()
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
            userFavorites.value = []
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

    async function fetchCategoriesFavorites() {
        try {
            const response = await axios.get('/api/product-categories')
            userFavorites.value = response.data
        } catch (e) {
            userFavorites.value = []
        }
    }

    onMounted(initAuth)

    return {
        user,
        isAuthenticated,
        isAuthResolved,
        userFavorites,
        loading,
        login,
        register,
        logout,
        refreshUser,
        initAuth,
    }
}
