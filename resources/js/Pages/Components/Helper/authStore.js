import {defineStore} from 'pinia';
import axios from "axios";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        Products: null,
        isAuthenticated: false,
    }),
    actions: {
        setUser(user) {
            this.user = user;
            this.Products = user.user_buy_cart;
            this.Orders = user.user_orders;
            this.isAuthenticated = !!user;
        },
        productIncrement(index, id) {
            this.Products[index].quantity++;
            axios.post(route('BuyCart.CartItemIncrement', id));
        },
        productDecrement(index, id) {
            if (this.Products[index].quantity > 0) {
                this.Products[index].quantity--;
                axios.post(route('BuyCart.CartItemDecrement', id));
            }
        },
        logout() {
            this.user = null;
            this.isAuthenticated = false;
        },
    },
    persist: true,
});
