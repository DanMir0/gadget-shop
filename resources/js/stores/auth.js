import {defineStore} from "pinia";
import router from "@/router/router.js";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        isAuthResolved: false,
        loading: false,
    }),
    getters: {
        isAuthenticated: (state) => !!state.user
    },
    actions: {
        setUser(user) {
            this.user = user
        },
        async logout() {
            try {
                await axios.post('/api/logout'); // Вызываем API выхода
                this.user = null;                // Сбрасываем пользователя в состоянии
                router.push('/login');           // Редирект на страницу входа
            } catch (error) {
                console.error('Ошибка выхода:', error);
            }
        },
        async fetchUser() {
            this.loading = true
            try {
                const response = await axios.get('/api/user')
                this.user = response.data
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    this.user = null;
                }
            } finally {
                this.isAuthResolved = true
                this.loading = false
            }
        },
        async login(email, password) {
            try {
                const response = await axios.post('/api/login', { email, password })
                this.setUser(response.data)
                this.isAuthResolved = true;
                return response;
            } catch (e) {
                throw e
            }
        },

        // Регистрация пользователя
        async register(data) {
            try {
                const response = await axios.post('/api/register', data)
                this.setUser(response.data);
                this.isAuthResolved = true;
                return response
            } catch (e) {
                throw e
            }
        }
    }
})
