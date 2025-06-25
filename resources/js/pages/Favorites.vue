<script setup>
import {useFavoritesStore} from "@/stores/favorites";
import {storeToRefs} from "pinia";
import {computed, onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const route = useRoute();
const path = ref(route.path);

const favoritesStore = useFavoritesStore();
const {userFavorites} = storeToRefs(favoritesStore);

function removeFromFavorites(product) {
    favoritesStore.removeFromFavorites(product.id); // Удалить из избранного
}

onMounted(async () => {
    await favoritesStore.fetchFavorites(); // Загрузить данные из API
});
</script>

<template>
    <g-container>
        <h1>Избранное</h1>
        <div class="block-items" v-for="(item, index) in userFavorites" :key="index">
            <h3 class="category-title">{{ item.category }}</h3>
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
