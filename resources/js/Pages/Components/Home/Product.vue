<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps(["image", "name", "special" ,"liked"]);
</script>

<template>
    <div
        class="relative group overflow-hidden flex w-fit rounded-lg shadow-sm hover:shadow-md
        hover:shadow-slate-500 duration-500 cursor-pointer bg-defaultColor6 py-6 flex-col hover3D-animation
         items-center gap-4 dark:bg-defaultColor7 dark:shadow-defaultColor">
        <!--        image-->
        <div class="w-60">
            <img :src="props.image" alt="" @dragstart.prevent class="size-full">
        </div>
        <!--        name-->
        <div class="flex px-4 justify-center w-full items-center">
            <h3 class="w-28 text-center">{{ props.name }}</h3>
        </div>
        <!--        price & buy cart-->
        <div class="w-full px-4 flex lg:justify-between items-center flex-col gap-2 lg:flex-row">
            <span class="text-defaultColor dark:text-defaultColor5">800,000 تومان</span>
            <span
                class="flex justify-between w-full lg:w-fit lg:block">
                <svg-component name="cart" class="size-7 duration-500 hover:translate-x-2 hover:text-defaultColor dark:hover:text-defaultColor5"></svg-component>
                <svg-component title="افزودن به علاقه مندی" name="like"
                               class="size-7 hover:fill-red-500 fill-transparent text-red-500 duration-500 dark:fill-defaultColor7 dark:hover:fill-red-900 dark:text-red-900 lg:hidden"></svg-component>
            <svg-component title="مشاهده محصول" name="show"
                           class="size-7 hover:text-defaultColor duration-500 lg:hidden"></svg-component>
            </span>
        </div>
        <!--        like & show-->
        <div
            class="absolute hidden top-0 bg-defaultColor4 p-2 -left-10 flex-col duration-500 items-center
             group-hover:left-0 rounded-lg dark:bg-defaultColor7 dark:bg-opacity-50 lg:flex">
            <svg-component title="افزودن به علاقه مندی" name="like"
                           class="size-6 hover:fill-red-500 fill-transparent text-red-500 duration-500
                           dark:fill-defaultColor7 dark:hover:fill-red-900 dark:text-red-900"
                            :class="{'!fill-red-500':liked}"></svg-component>
            <svg-component title="مشاهده محصول" name="show"
                           class="size-6 hover:text-defaultColor duration-500"></svg-component>
        </div>
        <div class="absolute top-0 right-0 py-5 rounded-b-full bg-red-600 text-slate-200 dark:bg-red-900"
             v-if="props.special===true">
            <p class="-rotate-90 mr-0.5">ویژه</p>
        </div>
    </div>
</template>
