<script setup>
import {useFavoritesStore} from "@/stores/favorites";
import {storeToRefs} from "pinia";
import {computed, onMounted, ref, watch} from "vue";
import {useRoute} from "vue-router";
import {useI18n} from "vue-i18n";
import {useLangStore} from "@/stores/lang.js";

const route = useRoute();
const path = ref(route.path);
const categoryTranslations = {
    smartpony: { ru: "Телефоны", en: "Phones"},
    noytbuki: { ru: "Ноутбуки", en: "Laptops"},
    plansheti: { ru: "Планшеты", en: "Tablets"},
    nayshniki: { ru: "Наушники", en: "Headphones"},
    accesyari: { ru: "Аксессуары", en: "Accessories"},
}
const favoritesStore = useFavoritesStore();
const {userFavorites} = storeToRefs(favoritesStore);
const {t} = useI18n()
const langStore = useLangStore()
function removeFromFavorites(product) {
    favoritesStore.removeFromFavorites(product.id); // Удалить из избранного
}

onMounted(async () => {
    await favoritesStore.fetchFavorites(); // Загрузить данные из API
});

watch(
    () => langStore.currentLang,
    async () => {
        await favoritesStore.fetchFavorites()
    }

)
</script>

<template>
    <g-container>
        <h1>{{ t('favorites.title') }}</h1>
        <div class="block-items" v-for="(item, index) in userFavorites" :key="index">
            <h3 class="category-title">{{ categoryTranslations[item.category]?.[langStore.currentLang] }}</h3>
            <g-products-list
                class="mb-47"
                :products="item.products"
                path="/favorites"
                @remove-from-favorites="removeFromFavorites"></g-products-list>
        </div>
    </g-container>
</template>

<style scoped>
.mb-47 {
    margin-bottom: 47px;
}

h1 {
    margin-bottom: 21px;
    margin-top: 50px;
}

.category-title {
    color: #838383;
    margin-bottom: 23px;
}

@media (max-width: 1200px) {
    .block-items {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

}
</style>
