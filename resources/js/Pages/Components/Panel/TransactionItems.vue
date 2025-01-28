<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
</script>

<template>
    <div class="flex w-full items-center justify-between p-2 rounded-lg border border-gray-500 bg-defaultColor
         text-white text-xs">
        <!--            success-->
        <div class="bg-defaultColor5 bg-opacity-70 p-2 rounded-full">موفق</div>
        <span class="h-8 bg-slate-400 rounded-full w-0.5"></span>
        <!--            date & time-->
        <div class="p-2 rounded-full border">1403/03/03</div>
        <!--            price-->
        <div class="rounded-full border border-amber-300 p-2 text-yellow-500 bg-amber-400 bg-opacity-50 *:pl-1"><span>100,000</span>تومان</div>
        <!--            show more button-->
        <svg-component name="arrow-left" class="size-5 text-defaultColor2 cursor-pointer"></svg-component>
    </div>
</template>
