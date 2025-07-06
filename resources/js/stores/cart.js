import { defineStore } from "pinia";

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: []
    }),
    getters: {
        totalPrice: (state) =>
            state.items.reduce((sum, item) => sum + item.price * item.quantity, 0),
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
        addToCart(product) {
            const existing = this.items.find((item) => item.id === product.id)
            if (existing) {
                existing.quantity += 1
            } else {
                this.items.push({ ...product, quantity: 1 })
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
