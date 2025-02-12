import {defineStore} from 'pinia';

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
            this.isAuthenticated = !!user;
        },
        productIncrement(index) {
            this.Products[index].quantity++;
            console.log(this.Products[index].quantity);
        },
        productDecrement(index) {
            this.Products[index].quantity > 0 ? this.Products[index].quantity-- : this.Products[index].quantity;
            console.log(this.Products[index].quantity);
        },
        logout() {
            this.user = null;
            this.isAuthenticated = false;
        },
    },
    persist: true,
});
