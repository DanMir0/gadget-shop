<script setup>
import {useAuth} from "@/composoble/useAuth.js";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const {userFavorites} = useAuth();

const path = ref("")

async function removeFromFavorites(product) {
    userFavorites.value = userFavorites.value.map(category => {
        return {
            ...category,
            products: category.products.filter(p => p.id !== product.id)
        };
    }).filter(category => category.products.length > 0);
}

onMounted(() => {
    const route = useRoute()
    path.value = route.path
})

</script>

<template>
    <g-container>
        <h1>Избранное</h1>
        <div class="block-items" v-for="(item, index) in userFavorites" :key="index">
            <h3 class="category-title">{{ item.category }}</h3>
            <g-products-list @remove-from-favorites="removeFromFavorites" :path="path" class="mb-47"
                             :products="item.products"></g-products-list>
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
