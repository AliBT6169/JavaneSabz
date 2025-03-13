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
        <div class="w-full space-y-6 pb-96 text-defaultColor dark:text-defaultColor5">
            <!--        page location-->
            <div class="w-full flex">
                <div class="flex items-center w-fit gap-2">
                    <Link href="/">
                <span
                    class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                    </Link>
                    <svg-component name="next" class="size-3"></svg-component>
                    <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span>
                </div>
            </div>
            <div class="space-y-6 lg:flex lg:space-y-0 gap-4 *:w-full">
                <!--                rightSide-->
                <div class="space-y-6">
                    <!--                    name-->
                    <h1 class="text-2xl font-black">
                        {{ product.data.name }}
                    </h1>
                    <!--            slider-->
                    <div class="w-full h-60 lg:h-96">
                        <Carousel v-bind="carouselConfig" class="!size-full">
                            <Slide v-for="slide in product.data.images" :key="slide" class="">
                                <div class="carousel__item !size-full">
                                    <img :src="slide.image" alt=""
                                         class="size-full select-none cursor-pointer rounded-xl bg-blue-600">
                                </div>
                            </Slide>
                            <template #addons>
                                <Pagination/>
                            </template>
                        </Carousel>
                    </div>
<!--                    size & rate-->
                    <div class="flex gap-4 *:w-full">
<!--                        size-->
                        <div class="p-1 rounded-lg bg-defaultColor5/50 text-red-600 border border-defaultColor/50">
                            <strong class="text-defaultColor dark:text-defaultColor5">سایز: </strong>
                            {{product.data.value}}
                        </div>
<!--                        rate-->
                        <div class="p-1 rounded-lg bg-defaultColor5/50 text-red-600 border border-defaultColor/50">

                        </div>
                    </div>
                </div>
                <!--                leftSide-->
                <div class=""></div>
            </div>

        </div>
        <Footer/>
    </div>
</template>
