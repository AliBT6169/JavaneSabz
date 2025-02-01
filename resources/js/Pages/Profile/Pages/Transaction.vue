<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import TransactionItems from "@/Pages/Components/Panel/TransactionItems.vue";
import {Transaction} from "@/Pages/Profile/DashboardContainer.js";


</script>

<template>
    <!--    container-->
    <div class="grid gap-4 place-items-center">
        <!--        item-->
        <TransactionItems v-for="item in Transaction" :transaction-data="item"></TransactionItems>
    </div>
</template>
