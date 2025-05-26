import {onMounted, ref} from "vue";

const user = ref(null)
const isAuthenticated = ref(false)
const isAuthResolved = ref(false)
const userFavorites = ref([])

export function useAuth() {
    onMounted(async () => {
        try {
            const response = await axios.get('/user') // можно и '/user', если Laravel route работает
            user.value = response.data
            isAuthenticated.value = !!user.value?.id

            if (isAuthenticated.value) {
                const favoritesResponse = await axios.get('/api/favorites')
                userFavorites.value = favoritesResponse.data
            }
        } catch (e) {
            user.value = null
            isAuthenticated.value = false
        } finally {
            isAuthResolved.value = true
        }
    })

    return {
        user,
        isAuthenticated,
        isAuthResolved,
        userFavorites,
    }
}
