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
import AdminAddress from "@/Pages/Admin/Components/Admin-Address.vue";
import SelectOrderUserModal from "@/Pages/Admin/pages/Order/SelectOrderUserModal.vue";

const form = ref({
    status: -1,
    coupon_amount: 0,
    address: null,
    city: null,
    postal_code: null,
    user_id: null,
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
            <div
                class="space-y-6 py-4 *:w-full *:h-20 d:space-y-0 md:flex md:flex-wrap md:justify-center md:gap-5 *:md:w-[45%]">
                <admin-address label="آدرس:" @update-value="form.city=$event"/>
                <admin-input v-model="form.address" name="آدرس"/>
                <admin-input v-model="form.postal_code" name="کد پستی"/>
                <admin-input @input="payAmountChanged" type="number" v-model="form.coupon_amount"
                             name="تخفیف"/>
                <div class="border-2 rounded-xl border-adminColor3 h-fit items-center flex justify-between w-full">
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
                <div class="adminOrderEditItems">
                    <div class="">هزینه ارسال:</div>
                    <div class="">{{ delivery_amount.toLocaleString('fa-IR') }}</div>
                </div>
                <div class="adminOrderEditItems">
                    <div class="">مالیات:</div>
                    <div class="">{{ VAT.toLocaleString('fa-IR') }}</div>
                </div>
                <div class="adminOrderEditItems">
                    <div class="">جمع کل:</div>
                    <div class="">{{ total_amount.toLocaleString('fa-IR') }}</div>
                </div>
                <div class="adminOrderEditItems">
                    <div class="">مبلغ پرداختی:</div>
                    <div class="">{{ paying_amount.toLocaleString('fa-IR') }}</div>
                </div>
                <div
                    class="space-y-6 py-4 !h-fit *:w-full md:space-y-0 md:flex md:flex-wrap md:justify-center md:gap-5 *:md:w-[45%]">
                    <AdminOrderItemsModal @dataSend="products = $event"/>
                    <SelectOrderUserModal v-model="form.user_id"/>
                </div>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end md:!w-[90%]">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.orders.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
