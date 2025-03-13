<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import 'vue3-carousel/carousel.css'
import {Carousel, Slide, Pagination} from 'vue3-carousel';
import Navigation from "@/Pages/Components/Home/navigation.vue";

const carouselConfig = {
    itemsToShow: 1,
    autoplay: 3000,
    dir: 'rtl',
    gap: 1,
    wrapAround: true,
    breakpointMode: 'carousel',
}
const props = defineProps(["product"]);
console.log(props.product.data);
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Header/>
        <Navigation/>
        <div class="w-full space-y-6 pb-96">
            <!--        page location-->
            <div class="w-full space- flex">
                <div class="flex items-center w-fit gap-2 px-4">
                    <Link href="/">
                <span
                    class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                    </Link>
                    <svg-component name="next" class="size-3"></svg-component>
                    <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span>
                </div>
            </div>
            <div class="w-60">
                <Carousel v-bind="carouselConfig">
                    <Slide v-for="slide in product.data.images" :key="slide">
                        <div class="carousel__item">
                            <img :src="slide.image" alt="" class="size-60 select-none cursor-pointer rounded-xl bg-blue-600">
                        </div>
                    </Slide>
                    <template #addons>
                        <Pagination/>
                    </template>
                </Carousel>
            </div>
        </div>
        <Footer/>
    </div>
</template>
