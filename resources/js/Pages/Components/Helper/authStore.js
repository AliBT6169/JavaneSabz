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
            this.Transactions = user.user_transactions;
            this.WishList = user.user_wish_list;
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
        likeOrUnLike(product_id, status) {
            if (this.user != null) {
                if (status) {
                    const form = {
                        product_id: product_id,
                        user_id: this.user.id,
                    }
                    axios.delete(route('wishlist.delete', {"id": product_id})).then(response => {
                        console.log(response.data);
                    }).catch(error => {
                        console.log(error);
                    })
                } else {
                    return;
                }
            } else
                axios.get(route('/login'));
        },
        logout() {
            this.user = null;
            this.isAuthenticated = false;
        },
    },
    persist: true,
});
