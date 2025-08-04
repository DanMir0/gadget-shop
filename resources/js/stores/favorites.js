import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";
import {useLangStore} from "@/stores/lang.js";

export const useFavoritesStore = defineStore("favorites", () => {
    const userFavorites = ref([]);
    const langStore = useLangStore()
    async function fetchFavorites() {
        const response = await axios.get("/api/product-categories", {
            params: {
                lang: langStore.currentLang
            }
        });
        userFavorites.value = response.data;
        console.log(userFavorites)
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
