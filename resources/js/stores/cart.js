import {defineStore} from "pinia";
import axios from "axios";

export const useCartStore = defineStore('cart', {
    state: () => {
        let storedItems = []

        try {
            const raw = localStorage.getItem('pinia-cart')
            if (raw) {
                const parsed = JSON.parse(raw)
                if (Array.isArray(parsed?.items)) {
                    storedItems = parsed.items
                }
            }
        } catch (e) {
            console.warn("Ошибка при чтении pinia-cart:", e)
        }

        return {
            items: storedItems
        }

    },
    getters: {
        totalPrice: (state) => {
            const total = state.items.reduce((sum, item) => sum + item.price * item.quantity, 0)
            return Number(total.toFixed(2))
        },
        totalCount: (state) =>
            state.items.reduce((sum, item) => sum + item.quantity, 0),
        hasProduct: (state) => {
            return (productId) => state.items.some(item => item.id === productId)
        },
        getQuantity: (state) => {
            return (productId) => {
                const item = state.items.find(item => item.id === productId);
                return item ? item.quantity : 0;
            }
        },
    },
    actions: {
        async loadCart(lang = 'ru') {
            try {
                const response = await axios.get('/api/get_cart', {
                    params: {
                        lang: lang
                    }
                })
                this.items = response.data
            } catch (e) {
                console.error(e)
            }
        },
        addToCart(product) {
            const existing = this.items.find((item) => item.id === product.id)
            if (existing) {
                existing.quantity += 1
            } else {
                this.items.push({...product, quantity: 1})
            }
        },
        removeFromCart(productId) {
            this.items = this.items.filter((item) => item.id !== productId)
        },
        clearCart() {
            this.items = []
        },
        decreaseQuantity(productId) {
            const item = this.items.find(item => item.id === productId)
            if (item) {
                if (item.quantity > 1) {
                    item.quantity -= 1
                } else {
                    this.removeFromCart(productId)
                }
            }
        },
    },
    persist: true,
})
