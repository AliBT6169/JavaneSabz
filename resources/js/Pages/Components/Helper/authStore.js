import {defineStore} from 'pinia';
import axios from "axios";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        Products: null,
        Orders: null,
        Transactions: null,
        WishList: null,
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
        async likeOrUnLike(product_id, like) {
            if (this.user != null) {
                if (like) {
                    await axios.delete(route('wishlist.destroy', [product_id, this.user.id])).then(response => {
                        this.WishList = response.data === 1 ? this.WishList.filter(wishList => wishList.product.id !== product_id) : this.WishList;
                    }).catch(error => {
                        console.log(error);
                    })
                } else {
                    await axios.post(route('wishlist.store', [product_id, this.user.id])).then(response => {
                        this.WishList.push({product: response.data});
                    }).catch(error => {
                        console.log(error);
                    });

                }
            } else
                window.location.href = '/login';
        },
        logout() {
            this.user = null;
            this.isAuthenticated = false;
        },
    },
    persist: true,
});
