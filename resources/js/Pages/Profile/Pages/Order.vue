<script setup>

import PaymentItem from "@/Pages/Components/Panel/OrderItem.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";
import OrderItem from "@/Pages/Components/Panel/OrderItem.vue";

const authStore = useAuthStore()
const Orders = ref(authStore.Orders);
</script>

<template>
    <div class="grid justify-center place-items-center gap-4 p-4 Sidebar lg:flex lg:flex-wrap ">
        <div v-if="Orders.length===0" class="">هنوز هیچ  سفارشی موجود نیست</div>
        <OrderItem v-for="item in Orders" :Order="item"/>
    </div>
</template>
