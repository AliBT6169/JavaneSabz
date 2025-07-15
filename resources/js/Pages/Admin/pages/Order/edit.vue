<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const props = defineProps({
    order: {
        required: true,
    }
});
console.log(props.order);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="space-y-6 md:*:flex md:*:justify-center *:gap-2">
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
                    <select class="adminOrderEditItems w-60 text-center bg-adminColor4" name="" id="">
                        <option :selected="order.data.status<3&&order.data.payment_status===0" value="-1">در انتظار
                            پرداخت
                        </option>
                        <option :selected="order.data.status===0" value="0">در انتظار تایید</option>
                        <option :selected="order.data.status===1" value="1">در انتظار آماده سازی</option>
                        <option :selected="order.data.status===2" value="2">ارسال شده</option>
                        <option :selected="order.data.status===3" value="3">مرجوع شده</option>
                        <option :selected="order.data.status===4" value="4">لغو شده</option>
                    </select>
                </div>
            </div>
            <div class="space-y-6 md:space-y-0">
                <admin-input :model-value="order.data.delivery_amount.toLocaleString('fa-IR')" name="هزینه ارسال"/>
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
                <admin-input :model-value="order.data.coupon_amount" name="کپن تخفیف"/>
            </div>
        </div>
    </Layout>
</template>
