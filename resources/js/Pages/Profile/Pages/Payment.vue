<script setup>

import PaymentItem from "@/Pages/Components/Panel/PaymentItem.vue";
import {Payments} from "@/Pages/Profile/DashboardContainer.js";

</script>

<template>
        <div class="grid justify-center place-items-center gap-4 p-4 Sidebar lg:flex lg:flex-wrap ">
        <PaymentItem v-for="item in Payments" :payment="item"/>
    </div>
</template>
