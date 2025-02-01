<script setup>

import {rand} from "@vueuse/core";
</script>

<template>
    <div class="space-y-2 duration-500 shadow-md shadow-gray-500 w-60 p-4 rounded-xl border-2 border-defaultColor h-96 overflow-scroll
     dark:bg-defaultColor5 dark:border-darkColor1 sm:w-96 hover3D-animation hover:shadow-red-500">
        <div class="flex gap-6 text-[8px] text-nowrap sm:text-sm">
            <div class="">در حال تائید</div>
            <div class="">در حال آماده سازی</div>
            <div class="">کالا ارسال شده</div>
        </div>
        <div class="flex justify-center items-center">
            <div class="size-5 rounded-full bg-defaultColor"></div>
            <div class="w-16 h-0.5 rounded-full bg-black sm:w-32"></div>
            <div class="size-5 rounded-full bg-defaultColor"></div>
            <div class="w-16 h-0.5 rounded-full bg-black sm:w-32"></div>
            <div class="size-5 rounded-full bg-defaultColor"></div>
        </div>
        <div class="space-y-2" v-for="item in rand(1,7)">
            <div class="flex gap-2 items-center">
                <img src="/images/products/Emamectin.jpg" alt="" class="w-14 border-red-500 border-2 rounded-full sm:w-16 md:!w-20">
                <div class="grid gap-1 text-xs sm:text-sm">
                    <strong class="">امامکتین بنزواتامامکتین بنزواتامامکتین بنزواتامامکتین بنزواتامامکتین بنزواتامامکتین بنزواتامامکتین بنزوات </strong>
                    <div class="">تعداد: <span>10</span></div>
                    <div class="">قیمت: <span>{{ (10000).toLocaleString('fa-IR') }}</span></div>
                </div>
            </div>
            <div class="bg-defaultColor7 w-full rounded-full h-0.5"></div>
        </div>
    </div>

</template>
