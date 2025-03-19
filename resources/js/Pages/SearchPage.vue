<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Navigation from "@/Pages/Components/Home/navigation.vue";
import {Carousel, Slide} from "vue3-carousel";
import {useSearchStore} from "@/Pages/Components/Helper/searchStore.js";
import Product from "@/Pages/Components/Home/Product.vue";

const carouselConfig = {
    itemsToShow: window.innerWidth < 800 ? 2 : 4,
    autoplay: 3000,
    dir: 'rtl',
    gap: 10,
    breakpointMode: 'carousel',
}

</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Header/>
        <Navigation/>
        <div class="flex flex-wrap p-4 gap-4 justify-center *:w-full sm:*:w-40">
            <product v-for="item in useSearchStore().allProducts" :product="item"></product>
        </div>
        <div
            class="w-full bg-defaultColor5 p-4 dark:bg-defaultColor overflow-hidden rounded-xl border border-white/50
            select-none cursor-pointer shadow-inner shadow-gray-600">
            <div class="w-fit pb-4 pr-8 space-y-2">
                <div class="text-xl text-defaultColor font-black dark:text-defaultColor5">محصولات ویژه</div>
                <div class="flex gap-4 *:rounded-full *:h-3 *:shadow-sm *:shadow-gray-600 *:bg-defaultColor *:dark:bg-defaultColor5">
                    <div class="w-1/5"></div>
                    <div class="w-4/5"></div>
                </div>
            </div>
            <Carousel v-bind="carouselConfig" class="!size-full">
                <Slide v-for="item in useSearchStore().allProducts">
                    <Product class="!w-60 h-full" :product="item" :special="true"/>
                </Slide>
            </Carousel>
        </div>
    </div>
</template>
