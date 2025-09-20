import {defineStore} from 'pinia';
import axios from "axios";
import {ref} from "vue";
import {useToast} from "vue-toastification";
import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";

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
        Time: Number,
    }),
    actions: {
        setUser(user) {
            this.user = user;
            this.Products = user.user_buy_cart;
            this.Orders = user.user_orders;
            this.Transactions = user.user_transactions;
            this.WishList = user.user_wish_list;
            this.isAuthenticated = !!user;
            this.Time = Date.now();
        },
        productIncrement(index, id) {
            this.Products[index].quantity++;
            axios.post(route('BuyCart.CartItemIncrement', id));
        },
        async productDecrement(index, id) {
            if (this.Products[index].quantity > 0)
                await axios.post(route('BuyCart.CartItemDecrement', id)).then((res) => {
                    this.Products[index].quantity--;
                });
        },
        async deleteItemFromCart(index, id) {
            const content = {
                component: ToastWarning,
                props: {
                    message: 'آیا مطمعن به حذف این محصول از سبد خرید خود هستید؟'
                },
                listeners: {
                    set: async () => {
                        await axios.delete(route('BuyCart.deleteItemFromCart', id)).then((response) => {
                            this.Products.splice(index, 1);
                            useToast().success(response.data);
                        });
                    }
                }
            }
            useToast().warning(content);
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
            } else window.location.href = '/login';
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
                window.location.href = '/login';
            return res.value;
        },
        async informationUpdate(form) {
            const formData = new FormData();
            formData.append("id", form.id);
            formData.append("image", form.image);
            formData.append("name", form.name);
            formData.append("full_name", form.full_name);
            formData.append("gender", form.gender);
            formData.append("cellphone", form.cellphone);
            formData.append("email", form.email);
            formData.append("address", form.address);
            formData.append("city", form.city_id);
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
        async orderMaker() {
            const result = await axios.get(route('BuyCart.completePayment')).then(res => {
                if (res.data.status === 100) {
                    useAuthStore().toastMessage('error', res.data.message);
                } else {
                    const authUser = this;
                    authUser.user = {
                        ...authUser.user,
                        user_orders: res.data,
                        user_buy_cart: []
                    }
                    this.setUser(authUser.user)
                    return true;
                }
            }).catch(err => {
                console.log(err);
            });
            return result;
        },
        async coupon_checker(coupon_code, order_id = -1) {
            console.log()
            axios.post(route('CouponChecker'), {'id': order_id, 'coupon_code': coupon_code}).then((res) => {
                console.log(res)
                this.Orders.splice(0, this.Orders.length, ...res.data);
            }).catch((err) => {
                console.log(err.response.data.message)
                this.toastMessage('error', err.response.data.message)
            })
        },
        toastMessage(methode = '', message = '') {
            switch (methode) {
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
            useAdminStore().logout();
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
