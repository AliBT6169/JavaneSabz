<script setup>

import SvgComponent from "@/Components/svg-component.vue";
</script>

<template>
    <div class="flex w-fit rounded-lg shadow-sm hover:shadow-lg hover:shadow-slate-500 duration-300 cursor-pointer px-4 bg-defaultColor6 py-6 flex-col items-center gap-4">
<!--        image-->
        <div class="size-40 rounded-lg overflow-hidden">
            <img src="../../../../public/images/products/Emamectin.jpg" alt="" class="size-full">
        </div>
<!--        name-->
        <div class="flex justify-center w-40 items-center">
            <h3 class="">امامکتین بنزوات</h3>
        </div>
<!--        price & buy cart-->
        <div class="w-40 flex justify-between items-center">
            <span class="text-defaultColor">800,000 تومان</span>
            <span class="hover:translate-x-2 duration-500 hover:text-defaultColor">
                <svg-component name="cart" class="size-6"></svg-component>
            </span>
        </div>
    </div>
</template>
