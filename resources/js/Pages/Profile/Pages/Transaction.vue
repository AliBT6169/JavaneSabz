<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import TransactionItems from "@/Pages/Components/Panel/TransactionItems.vue";
</script>

<template>
    <!--    container-->
    <div class="grid gap-4 place-items-center">
        <!--        item-->
        <TransactionItems v-for="items in 10"></TransactionItems>
    </div>
</template>
