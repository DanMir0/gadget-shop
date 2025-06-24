import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useCategoryStore = defineStore('category', () => {
    const categories = ref([])
    const loading = ref(false)

    async function fetchCategories() {
        loading.value = true
        try {
            const response = await axios.get('/api/categories')
            categories.value = response.data
        } catch (error) {
            console.error('Ошибка при загрузке категорий:', error)
        } finally {
            loading.value = false
        }
    }

    return { categories, loading, fetchCategories }
})
