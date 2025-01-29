<script setup>

import PanelCartItems from "@/Pages/Components/Panel/PanelCartItems.vue";
import {Products} from "@/Pages/Profile/DashboardContainer.js";

</script>

<template>
    <div class="mb-4 px-4 py-2 rounded-lg bg-defaultColor2 border grid gap-2 text-white sm:flex
         sm:items-center sm:justify-between sm:rounded-full">
        <div class="flex justify-between"><span> تعداد محصولات : </span><span>32</span></div>
        <div class="flex justify-between"><span>جمع کل :</span><span>30,000,000 تومان</span></div>
        <button class="p-2 rounded-full text-center duration-300 border-2 bg-defaultColor
            hover:!bg-opacity-70 dark:bg-defaultColor5">تکمیل پرداخت
        </button>
    </div>
    <div class="grid gap-4">
        <PanelCartItems v-for="(item , index) in Products" :product="item" :index="index"></PanelCartItems>
    </div>
</template>
