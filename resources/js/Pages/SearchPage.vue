<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Navigation from "@/Pages/Components/Home/navigation.vue";
import {Carousel, Slide} from "vue3-carousel";
import {useSearchStore} from "@/Pages/Components/Helper/searchStore.js";
import Product from "@/Pages/Components/Home/Product.vue";

const carouselConfig = {
    itemsToShow: window.innerWidth<800?2:4,
    autoplay: 3000,
    dir: 'rtl',
    gap: 1,
    breakpointMode: 'carousel',
}

</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Header/>
        <Navigation/>
        <div class="w-full bg-defaultColor5 dark:bg-defaultColor overflow-hidden rounded-xl border border-white/50 select-none cursor-pointer">
            <Carousel v-bind="carouselConfig" class="!size-full">
                <Slide v-for="item in useSearchStore().allProducts">
                    <Product class="!w-60 " :product="item"/>
                </Slide>
            </Carousel>
        </div>
    </div>
</template>
