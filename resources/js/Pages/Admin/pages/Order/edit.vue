<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import AdminOrderItemsModal from "@/Pages/Admin/Components/AdminOrderItemsModal.vue";

const props = defineProps({
    order: {
        required: true,
    }
});

const form = ref({
    id: props.order.data.id,
    status: props.order.data.payment_status === 0 ? -1 : props.order.data.status,
    coupon_amount: props.order.data.coupon_amount,
});

const paying_amount = ref(props.order.data.total_amount + props.order.data.VAT + props.order.data.delivery_amount - props.order.data.coupon_amount);
const products = ref([]);

const payAmountChanged = () => {
    paying_amount.value = props.order.data.total_amount + props.order.data.VAT + props.order.data.delivery_amount - form.value.coupon_amount
}
console.log(props.order);

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به آپدیت این سفارش هستید؟'
        },
        listeners: {
            set: async () => {
                const filteredProducts = ref(products.value.map(({
                                                                     images,
                                                                     name,
                                                                     value,
                                                                     weight,
                                                                     price,
                                                                     quantity,
                                                                     sale_price,
                                                                     ...rest
                                                                 }) => rest));
                const data = ref(form.value);
                data.value.items = filteredProducts.value;
                console.log(data.value)
                await axios.post(route('admin.orders.update'), data.value, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                }).then(res => {
                    useToast().success(res.data);
                }).catch(err => {
                    useToast().error(err.response.data.message)
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);

}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <form @submit.prevent="sendData">
            <div class="space-y-6 py-4 md:*:flex md:*:justify-center *:gap-2">
                <div class="space-y-6 md:space-y-0">
                    <div class="adminOrderEditItems">
                        <div class="">تاریخ:</div>
                        <div class="">{{ order.data.created_at }}</div>
                    </div>
                    <div class="adminOrderEditItems">
                        <div class="">کد:</div>
                        <div class="">{{ order.data.code }}</div>
                    </div>
                </div>
                <div class="space-y-6 md:space-y-0">
                    <div class="adminOrderEditItems">
                        <div class="">اقلام:</div>
                        <div class="">{{ order.data.items.length }}</div>
                    </div>
                    <div class="border-2 rounded-xl border-adminColor3 items-center flex justify-between w-full">
                        <div class="">وضعیت:</div>
                        <select @change="form.status = Number($event.target.value)"
                                class="adminOrderEditItems w-60 text-center cursor-pointer bg-adminColor2 dark:bg-adminColor4"
                                name="" id="">
                            <option :selected="form.status===-1" value="-1">در انتظار
                                پرداخت
                            </option>
                            <option :selected="form.status===0" value="0">در انتظار تایید</option>
                            <option :selected="form.status===1" value="1">در انتظار آماده سازی</option>
                            <option :selected="form.status===2" value="2">ارسال شده</option>
                            <option :selected="form.status===3" value="3">مرجوع شده</option>
                            <option :selected="form.status===4" value="4">لغو شده</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-6 md:space-y-0">
                    <div class="adminOrderEditItems">
                        <div class="">هزینه ارسال:</div>
                        <div class="">{{ order.data.delivery_amount.toLocaleString('fa-IR') }}</div>
                    </div>
                    <div class="adminOrderEditItems">
                        <div class="">مالیات:</div>
                        <div class="">{{ order.data.VAT.toLocaleString('fa-IR') }}</div>
                    </div>
                </div>
                <div class="space-y-6 md:space-y-0">
                    <div class="adminOrderEditItems">
                        <div class="">جمع کل:</div>
                        <div class="">{{ order.data.total_amount.toLocaleString('fa-IR') }}</div>
                    </div>
                    <admin-input @input="payAmountChanged" type="number" v-model="form.coupon_amount"
                                 name="تخفیف"/>
                </div>
                <div class="space-y-6 md:space-y-0">
                    <div class="adminOrderEditItems">
                        <div class="">مبلغ پرداختی:</div>
                        <div class="">{{ paying_amount.toLocaleString('fa-IR') }}</div>
                    </div>
                </div>
                <AdminOrderItemsModal :order_items="order.data.items"
                                      @dataSend="products = $event,console.log(products)"/>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.orders.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
