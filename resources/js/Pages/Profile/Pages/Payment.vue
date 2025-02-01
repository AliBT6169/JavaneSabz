<script setup>

import PaymentItem from "@/Pages/Components/Panel/PaymentItem.vue";
</script>

<template>
        <div class="grid justify-center place-items-center gap-4 p-4 Sidebar lg:flex lg:flex-wrap ">
        <PaymentItem v-for="item in 10"/>
    </div>
</template>
