<script setup>

import SvgComponent from "@/Components/svg-component.vue";

const props = defineProps(["image", "name" ,"special"]);
</script>

<template>
    <div class="relative group overflow-hidden flex w-fit rounded-lg shadow-sm hover:shadow-lg hover:shadow-slate-500 duration-300 cursor-pointer px-4 bg-defaultColor6 py-6 flex-col items-center gap-4">
<!--        image-->
        <div class="size-40 rounded-lg overflow-hidden">
            <img :src="props.image" alt="" @dragstart.prevent class="size-full">
        </div>
<!--        name-->
        <div class="flex justify-center w-40 items-center">
            <h3 class="">{{ props.name }}</h3>
        </div>
<!--        price & buy cart-->
        <div class="w-40 flex justify-between items-center">
            <span class="text-defaultColor">800,000 تومان</span>
            <span class="hover:translate-x-2 duration-500 hover:text-defaultColor">
                <svg-component name="cart" class="size-6"></svg-component>
            </span>
        </div>
<!--        like & show-->
        <div class="absolute top-0 bg-defaultColor4 p-2 -left-10 flex flex-col duration-500 items-center group-hover:left-0 rounded-lg">
            <svg-component title="افزودن به علاقه مندی" name="like" class="size-6 hover:fill-red-500 fill-white text-red-500 duration-500"></svg-component>
            <svg-component title="مشاهده محصول" name="show" class="size-6 hover:text-defaultColor duration-500"></svg-component>
        </div>
        <div class="absolute top-0 right-0 py-5 rounded-b-full bg-red-600 text-slate-200" v-if="props.special===true">
            <p class="-rotate-90 mr-0.5">ویژه</p>
        </div>
    </div>
</template>
