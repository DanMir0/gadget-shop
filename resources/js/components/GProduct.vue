<script setup>
import GButton from "@/components/ui/GButton.vue";
import {ref} from "vue";
import axios from "axios";
import {useAuth} from "@/composoble/useAuth.js";
import router from "@/router/router.js";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
    path: {
        type: String,
    }
});
const {isAuthenticated} = useAuth()
const emit =  defineEmits(['remove-from-favorites'])

const isFavorite = ref(props.product.is_favorite)
async function toggleFavorite() {
    if (!isAuthenticated.value) router.push({name: 'Login'})
    isFavorite.value = !isFavorite.value
    try {
        const response = await axios.post(`/api/favorites/${props.product.id}`)
        isFavorite.value = response.data.favorited;
    } catch (e) {

    }
}

async function handlerToggle(product) {
    if (props.path !== '/favorites') {
       await toggleFavorite()
    } else {
        await toggleFavorite()
        emit('remove-from-favorites', product)
    }

}
</script>

<template>
    <article class="product">
       <div class="image-wrapper">
           <img class="product-image" :src="product.image" :alt="product.name">
           <button class="favorite-button" @click="handlerToggle(product)">
               <svg
                   version="1.0"
                   xmlns="http://www.w3.org/2000/svg"
                   width="26"
                   height="26"
                   viewBox="0 0 512 457"
                   preserveAspectRatio="xMidYMid meet"
                   :fill="isFavorite ? 'red' : 'none'"
                   stroke="red"
                   stroke-width="260"
               >
                   <g transform="translate(0,457) scale(0.1,-0.1)">
                       <path d="M1335 4559 c-628 -86 -1133 -533 -1285 -1134 -74 -290 -64 -577 30
            -856 62 -187 141 -331 270 -494 82 -104 1951 -1977 2010 -2014 55 -36 138 -61
            200 -61 55 0 141 24 190 52 45 27 1854 1830 1972 1967 197 227 308 448 369
            731 31 140 33 436 6 575 -64 317 -198 567 -426 796 -230 229 -488 367 -802
            425 -143 27 -430 25 -565 -4 -254 -55 -502 -174 -676 -323 -31 -27 -61 -49
            -66 -49 -6 0 -34 21 -64 46 -178 153 -424 271 -675 324 -114 24 -377 35 -488
            19z"/>
                   </g>
               </svg>

           </button>
       </div>
        <div class="product-info">
            <div class="product-title">
                <p class="text product-name">{{ product.name }}</p>
                <p class="text product-price">{{ product.price.toLocaleString() }} ₽</p>
            </div>
            <div>
                <p class="product-description">{{ product.description }}</p>
            </div>
            <div class="product-block-stock">
                <p class="product-stock">Осталось: <strong>{{ product.stock }}</strong></p>
            </div>
            <g-button class="buy-button">Купить</g-button>
        </div>
    </article>
</template>

<style scoped>
.image-wrapper {
    position: relative;
    width: 100%;
}

.favorite-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 5px;
    z-index: 10;
}

.favorite-button svg {
    transition: fill 0.3s ease;
}



.product {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    background-color: #fff; /* Белый фон */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Увеличенная тень */
    padding: 20px;
    max-width: 350px;
    border-radius: 12px;
    gap: 10px;
    transition: transform 0.2s; /* Плавный эффект при наведении */
    min-height: 500px;
}

.product:hover {
    transform: translateY(-5px); /* Подъем при наведении */
}

.product-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 5px;
}

.product-info {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 10px;
}

.text {
    font-size: 18px;
    font-weight: 600;
}

.product-name {
    max-width: 170px;
    overflow: hidden; /* Предотвращение переполнения текста */
    white-space: nowrap; /* Однострочный текст */
    text-overflow: ellipsis;
}

.product-price {
    color: #FFA542;
}

.product-description {
    color: #777;
}

.product-image {
    width: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.product-stock {
    color: #444;
}

.product-block-stock {
    text-align: center;
}

.buy-button {
    margin-top: 10px;
    background: #E44D26; /* Цвет кнопки */
    color: #fff; /* Цвет текста на кнопке */
    border: none; /* Убираем границу */
    border-radius: 6px; /* Округление углов кнопки */
    padding: 10px 15px; /* Отступы */
    cursor: pointer; /* Указатель при наведении */
    transition: background-color 0.3s; /* Плавный переход цвета фона */
}

.buy-button:hover {
    background-color: #FFA542; /* Цвет кнопки при наведении */
}

@media (max-width: 768px) {
    .product {
        padding: 14px;
        min-height: auto;
    }

}
</style>

