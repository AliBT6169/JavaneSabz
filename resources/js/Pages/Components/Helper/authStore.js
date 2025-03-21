import {defineStore} from 'pinia';
import axios from "axios";
import {ref} from "vue";
import {toArray} from "@vueuse/core";
import {useToast} from "vue-toastification";

const toast = useToast();
export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        Products: null,
        Orders: null,
        Transactions: null,
        WishList: null,
        isAuthenticated: false,
        Toast: null,
        toastTimer: null,
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
        async productDecrement(index, id) {
            if (this.Products[index].quantity > 0) {
                await axios.post(route('BuyCart.CartItemDecrement', id)).then((response) => {
                    if (response.data === 'deleted') {
                        this.Products.splice(index, 1);
                    } else
                        this.Products[index].quantity--;
                });
            }
        },
        async addToCart(id) {
            if (this.isAuthenticated) {
                await axios.post(route('BuyCart.adToBuyCart', id)).then(response => {
                    if (response.data.method === 'increment') {
                        this.Products.map((item) => {
                            if (item.id === response.data.data)
                                item.quantity++;
                        });
                    } else if (response.data.method === 'create') {
                        this.Products.push(response.data.data[0]);
                    }
                    toast.success(response.data.method === 'increment' ? 'مجودی محصول در سبد اضافه شد' : 'محصول به سبد اضافه شد');
                }).catch(error => {
                    console.log(error);
                });
            } else toast.warning('لطفا اول وارد حساب کاربری خود شوید')
        },
        async CartCompleter() {
            if (this.user.full_name === null || this.user.cellphone === null || this.user.user_address === null || this.user.user_post_code === null)
                toast.error('اطلاعات خود را در پروفایل کامل کنید');
            else {
                await axios.get(route('BuyCart.UserCartChecker')).then((res) => {
                    if (res.data.message === 'is empty')
                        toast.warning('سبد خرید شما خالی است.')
                    else {
                        this.Products = [];
                        toast.success('پرداخت موفقیت آمیز بود')
                    }
                }).catch((err) => {
                    console.log(er.response.data);
                });
            }
        },
        async likeOrUnLike(product_id, like) {
            const res = ref(like);
            if (this.isAuthenticated) {
                if (like) {
                    await axios.delete(route('wishlist.destroy', [product_id, this.user.id])).then(response => {
                        this.WishList = response.data === 1 ? this.WishList.filter(wishList => wishList.product.id !== product_id) : this.WishList;
                        res.value = false;
                    }).catch(error => {
                        console.log(error.response.data.message);
                    })
                } else {
                    await axios.post(route('wishlist.store', [product_id, this.user.id])).then(response => {
                        this.WishList.push({product: response.data});
                        res.value = true;
                    }).catch(error => {
                        console.log(error.response.data.message);
                    });

                }
            } else
                toast.warning('لطفا اول وارد حساب کاربری خود شوید');
            return res.value;
        },
        async informationUpdate(form) {
            const formData = new FormData();
            formData.append("id", form.id);
            formData.append("image", form.image);
            formData.append("username", form.name);
            formData.append("full_name", form.full_name);
            formData.append("gender", form.gender);
            formData.append("mobile", form.cellphone);
            formData.append("email", form.email);
            formData.append("address", form.address);
            formData.append("post_code", form.post_code);
            await axios.post('/user/update', formData).then((response) => {
                this.user = response.data.data;
                toast.success('تغییرات با موفقیت ذخیره شدند')
            }).catch((error) => {
                const values = Object.values(error.response.data.errors);
                values.map((item) => {
                    toast.error(item[0]);
                });
            })
        },
        toastMessage(methode = '', message = '') {
            switch (method) {
                case 'error':
                    toast.error(message);
                    break;
                case 'success':
                    toast.success(message);
                    break;
                case 'warning':
                    toast.warning(message);
                    break;
                default:
                    toast(message);
                    break;
            }
        },
        logout() {
            this.user = null;
            this.Products = null;
            this.Orders = null;
            this.Transactions = null;
            this.WishList = null;
            this.isAuthenticated = false;
        },
    },
    persist: true,
});
