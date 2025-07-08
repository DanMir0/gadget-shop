<script setup>
import {useCartStore} from "@/stores/cart.js";
import axios from "axios";

const cart = useCartStore()

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
    <g-container>
        <h1 class="title">Корзина</h1>

        <div v-if="cart.items.length === 0" class="empty-cart">
            Ваша корзина пуста
        </div>

        <div v-else class="cart-wrapper">
            <div class="scrollable-row">
                <g-products-list class="lists-cart" :products="cart.items" />
            </div>
            <hr class="cart-separator" />

            <div class="cart-summary">
                <p class="total-label">Итого:</p>
                <p class="total-price">{{ cart.totalPrice }}₽</p>
            </div>

            <button class="submit-button" @click="submitOrder">Оформить заказ</button>
        </div>
    </g-container>
</template>

<style scoped>
.scrollable-row {
    max-width: 100%;
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 20px;
    margin-bottom: 20px;
}

/* Стилизация горизонтального скроллбара */
.scrollable-row::-webkit-scrollbar {
    height: 6px;
}
.scrollable-row::-webkit-scrollbar-thumb {
    background-color: #ffa500;
    border-radius: 10px;
}
.scrollable-row::-webkit-scrollbar-track {
    background-color: #eaeaea;
}

.title {
    margin-top: 50px;
    margin-bottom: 24px;
    font-size: 32px;
    font-weight: bold;
    text-align: center;
}

.empty-cart {
    font-size: 18px;
    text-align: center;
    margin-top: 40px;
}

.cart-wrapper {
    margin: 0 auto 120px auto;
    padding: 20px;
    background-color: #f1f1f1;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(255, 165, 0, 0.1);
}

.lists-cart {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    gap: 20px;
}

.cart-separator {
    margin: 30px 0;
    border: 0;
    height: 2px;
    background: linear-gradient(to right, #ff7a00, #ffae42, #ff7a00);
    border-radius: 2px;
}

.cart-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 20px;
    margin-bottom: 20px;
}

.total-label {
    font-weight: 600;
    font-size: 24px;
}

.total-price {
    font-weight: 700;
    color: #ffa500;
}

.submit-button {
    background-color: #ff7a00;
    color: white;
    border: none;
    padding: 14px 28px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
    width: 100%;
}

.submit-button:hover {
    background-color: #e06600;
}

@media (max-width: 1024px) {
    .cart-wrapper {
        padding: 16px;
    }

    .title {
        font-size: 28px;
    }

    .cart-summary {
        font-size: 18px;
    }

    .submit-button {
        font-size: 15px;
        padding: 12px 20px;
    }
}

@media (max-width: 768px) {
    .title {
        font-size: 24px;
    }

    .cart-summary {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .submit-button {
        font-size: 14px;
        padding: 12px 16px;
    }
}

@media (max-width: 480px) {
    .cart-wrapper {
        padding: 12px;
    }

    .title {
        font-size: 20px;
    }

    .cart-summary {
        font-size: 16px;
    }

    .submit-button {
        font-size: 14px;
        padding: 12px;
    }
}

</style>
