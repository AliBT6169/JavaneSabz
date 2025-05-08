<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import TransactionItems from "@/Pages/Components/Panel/TransactionItems.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";

const Transactions = ref(useAuthStore().Transactions);

</script>

<template>
    <!--    container-->
    <div class="grid gap-4 place-items-center">
        <div class="mb-4 px-4 py-2 rounded-lg bg-defaultColor2 border grid gap-2 text-white sm:flex
         sm:items-center sm:justify-between sm:rounded-full sm:w-full">
            <div class="flex justify-between">
                <span> تعداد تراکنش ها : </span><span>{{
                    Transactions.length
                }}</span>
            </div>
            <div class="flex justify-between">
                <span>جمع مبلغ :</span><span>{{Transactions.reduce((accumulator , Transactions)=> accumulator + Transactions.price, 0)}}</span>
            </div>
        </div>
        <!--        item-->
        <TransactionItems v-for="item in Transactions" :transaction-data="item"/>
    </div>
</template>
