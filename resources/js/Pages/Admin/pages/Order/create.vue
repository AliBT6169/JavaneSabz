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

const form = ref({
    status: -1,
    coupon_amount: 0,
});
const total_amount = ref(0);
const VAT = ref(0);
const delivery_amount = ref(0);
const coupon_amount = ref(0);
const paying_amount = ref(0);
const products = ref([]);

const payAmountChanged = () => {
    paying_amount.value = total_amount.value + VAT.value + delivery_amount.value - coupon_amount.value;
}

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این سفارش هستید؟'
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
                await axios.post(route('admin.orders.store'), data.value).then(res => {
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
                        <div class="">اقلام:</div>
                        <div class="">{{ products.length.toLocaleString('fa-IR') }}</div>
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
                        <div class="">{{delivery_amount.toLocaleString('fa-IR') }}</div>
                    </div>
                    <div class="adminOrderEditItems">
                        <div class="">مالیات:</div>
                        <div class="">{{ VAT.toLocaleString('fa-IR') }}</div>
                    </div>
                </div>
                <div class="space-y-6 md:space-y-0">
                    <div class="adminOrderEditItems">
                        <div class="">جمع کل:</div>
                        <div class="">{{ total_amount.toLocaleString('fa-IR') }}</div>
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
                <AdminOrderItemsModal @dataSend="products = $event"/>
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
