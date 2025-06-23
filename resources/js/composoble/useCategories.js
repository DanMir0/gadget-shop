import {onMounted, ref} from "vue";

export function useCategories() {
    const categories = ref([])
    const loading = ref(false)
    async function fetchCategories() {
        loading.value = true
        try {
            const response = await axios.get(`/api/categories`);
            categories.value = response.data;
        } catch (error) {
            console.log(error)
        } finally {
            loading.value = false;
        }
    }

    onMounted(fetchCategories)

    return {
        categories,
        fetchCategories,
        loading
    }
}
