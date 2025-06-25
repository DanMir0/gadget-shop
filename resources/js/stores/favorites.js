import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";

export const useFavoritesStore = defineStore("favorites", () => {
    const userFavorites = ref([]);

    async function fetchFavorites() {
        const response = await axios.get("/api/product-categories");
        userFavorites.value = response.data;
    }

    function removeFromFavorites(productId) {
        userFavorites.value = userFavorites.value.map(category => ({
            ...category,
            products: category.products.filter(p => p.id !== productId)
        })).filter(category => category.products.length > 0);
    }

    return {
        userFavorites,
        fetchFavorites,
        removeFromFavorites
    };
});
