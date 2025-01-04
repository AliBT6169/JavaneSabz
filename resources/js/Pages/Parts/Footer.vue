<script setup>

import SvgComponent from "@/Components/svg-component.vue";
</script>

<template>
    <div class="w-screen bg-defaultColor7 flex justify-center items-center rounded-t-full overflow-hidden">
        <div class="w-[80rem] py-10 grid grid-cols-5 items-center justify-center">
            <div class="flex duration-300 text-defaultColor5 items-center cursor-pointer gap-2 hover:-translate-x-2" v-for="item in 30">
                <svg-component name="circle" class="size-3"></svg-component>
                <h3 class="">شورت کات</h3>
            </div>
        </div>
    </div>
</template>
