<script setup>
import {useCartStore} from "@/stores/cart.js";
import axios from "axios";

const cart = useCartStore()

function removeItem(id) {
    cart.removeFromCart(id)
}

async function submitOrder() {
    try {
        const order = {
            items: cart.items.map(({id, quantity}) => ({
                product_id: id,
                quantity,
            }))
        }

        await axios.post('/api/orders', order)
        alert("Заказ оформлен!")
        cart.clearCart()
    } catch (e) {
        alert("ошибка при оформлении заказа")
        console.error(e)
    }
}
</script>

<template>
    <div class="container">
        <h2>Корзина</h2>
        <div v-if="cart.items.length === 0">Корзина пуста</div>
        <div v-else>
            <div v-for="item in cart.items" :key="item.id" class="item">
                <p>{{ item.name }} — {{ item.quantity }} шт. x {{ item.price }}₽</p>
                <button @click="removeItem(item.id)">Удалить</button>
            </div>
            <hr>
            <p><strong>Итого: {{ cart.totalPrice }}₽</strong></p>
            <button @click="submitOrder">Оформить заказ</button>
        </div>
    </div>
</template>

<style scoped>

</style>
