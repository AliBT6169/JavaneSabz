<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    order: {
        required: true,
    }
});
</script>

<template>
    <div
        class="p-2 rounded-xl border-2 border-gray-500 space-y-2 w-60 bg-adminColor1 *:flex *:justify-between *:items-center *:border-b *:border-gray-500 *:pb-1 dark:bg-adminColor4">
        <div class="!justify-center">
            <div class="">{{ order.created_at }}</div>
        </div>
        <div class="">
            <div class="">کد سفارش:</div>
            <div class="">{{ order.code }}</div>
        </div>
        <div class="">
            <div class="">کاربر:</div>
            <div class="">{{ order.user.name }}</div>
        </div>
        <div class="">
            <div class="">وضعیت:</div>
            <div v-if="order.payment_status===0" class="">در انتظار پرداخت</div>
            <div v-else class="">
                <div v-if="order.status===0" class="">در انتظار تایید</div>
                <div v-if="order.status===1" class="text-blue-600">در انتظار آماده سازی</div>
                <div v-if="order.status===2" class="text-green-500">ارسال شده</div>
                <div v-if="order.status===3" class="text-red-500">مرجوع شده</div>
            </div>
        </div>
        <div class="">
            <div class="">محصولات :</div>
            <div class="">{{ order.items.length }}</div>
        </div>
        <div class="">
            <div class="">مجموع قیمت:</div>
            <div class="">{{ order.total_amount.toLocaleString('fa-IR') }}</div>
        </div>
        <div class="">
            <div class="">تخفیف:</div>
            <div class="">{{ order.coupon_amount.toLocaleString('fa-IR') }}</div>
        </div>
        <div class="">
            <div class="">هزینه ارسال:</div>
            <div class="">{{ order.delivery_amount.toLocaleString('fa-IR') }}</div>
        </div>
        <div class="">
            <div class="">قابل پرداخت:</div>
            <div class="">{{ order.paying_amount.toLocaleString('fa-IR') }}</div>
        </div>
        <div class="">
            <Link :href="route('admin.orders.edit',order)" class="border-2 px-2 rounded-lg border-gray-400 bg-adminColor2">عملیات</Link>
            <div class="border-2 px-2 rounded-lg border-gray-400 bg-red-500">لغو سفارش</div>
        </div>
    </div>
</template>
