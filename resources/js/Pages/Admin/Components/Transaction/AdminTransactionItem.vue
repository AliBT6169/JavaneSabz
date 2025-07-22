<script setup>
import AdminTransactionProductShowModal from "@/Pages/Admin/pages/Transactions/AdminTransactionProductShowModal.vue";

const props = defineProps({
    transaction: {
        required: true,
        type: Object,
    }
})
</script>

<template>

    <div
        class="space-y-3 border-2 rounded-xl p-1 border-adminColor3 *:w-fit *:m-auto md:*:w-60 *:space-y-1 *:text-center
         md:flex md:justify-between md:items-center">
        <div class="">
            <div class="">تاریخ:</div>
            <div class="">{{ transaction.created_at }}</div>
        </div>
        <div class="*:px-2 *:py-1 *:rounded-xl *:border">
            <div class="">وضعیت:</div>
            <div v-if="transaction.status===0" class="bg-red-500/50 border-red-500">ناموفق</div>
            <div v-else-if="transaction.status===1" class="bg-yellow-500/50 border-yellow-500">نامعلوم</div>
            <div v-if="transaction.status===2" class="bg-green-500/50 border-green-500">موفق</div>
        </div>
        <div class="">
            <div class="">کاربر:</div>
            <div class="">{{ transaction.user }}</div>
        </div>
        <div class="">
            <div class="">کد رهگیری:</div>
            <div class="">{{ transaction.ref_id }}</div>
        </div>
        <div class="">
            <div class="">درگاه پرداخت:</div>
            <div class="">{{ transaction.gateway_name }}</div>
        </div>
        <div class="">
            <AdminTransactionProductShowModal :products="transaction.items"/>
        </div>
    </div>
</template>
