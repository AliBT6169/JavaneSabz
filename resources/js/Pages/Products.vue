<script setup>
import IndexLyout from "@/Pages/IndexLyout.vue";
import ProductSlider1 from "@/Pages/Components/Home/product-slider1.vue";
import {Carousel, Slide, Pagination} from "vue3-carousel";
import Product from "@/Pages/Components/Home/Product.vue";

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});
console.log(props.data);
const carouselConfig = {
    itemsToShow: Math.floor(window.innerWidth / 300),
    autoplay: 3000,
    dir: 'rtl',
    gap: 10,
    breakpointMode: 'carousel',
}
const carouselConfig2 = {
    itemsToShow: Math.floor(window.innerWidth / 600),
    autoplay: 3000,
    dir: 'rtl',
    gap: 1,
}
</script>

<template>
    <IndexLyout>
        <!--        off sales-1-->
        <div data-aos="fade-up" class="w-full mx-auto !transform-none">
            <div class="w-fit !static mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">محصولات</span>
                    <span class="font-black text-defaultColor5">تخفیف دار</span>

                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <product-slider1 :products="data.havOffSale.data" class="w-full"/>
        </div>

        <!--        specials-->
        <div
            class="w-full bg-defaultColor5 p-4 dark:bg-defaultColor overflow-hidden rounded-xl border border-white/50
            select-none cursor-pointer shadow-inner shadow-gray-600">
            <div class="w-fit pb-4 pr-8 space-y-2">
                <div class="text-xl text-defaultColor font-black dark:text-defaultColor5">محصولات ویژه</div>
                <div
                    class="flex gap-4 *:rounded-full *:h-3 *:shadow-sm *:shadow-gray-600 *:bg-defaultColor *:dark:bg-defaultColor5">
                    <div class="w-1/5"></div>
                    <div class="w-4/5"></div>
                </div>
            </div>
            <Carousel v-bind="carouselConfig" :wrap-around="true" class="!size-full">
                <Slide v-for="item in data.specials.data">
                    <Product class="!w-60 h-full" :product="item" :special="true"/>
                </Slide>
            </Carousel>
        </div>

        <!--        sale full-->
        <div data-aos="fade-up" class="w-full mx-auto !transform-none space-y-10">
            <div class="w-fit !static mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">محصولات</span>
                    <span class="font-black text-defaultColor5">پرفروش</span>

                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <Carousel v-bind="carouselConfig2" :wrap-around="true">
                <Slide v-for="item in data.saleFulls.data">
                    <Product :product="item"/>
                </Slide>
            </Carousel>
        </div>

        <!--        all products-->
        <div data-aos="fade-up" class="w-full mx-auto !transform-none space-y-10">
            <div class="w-fit !static mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">همه</span>
                    <span class="font-black text-defaultColor5">محصولات</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <div class="flex gap-5 flex-wrap justify-center items-center">
                <Product v-for="item in data.All.data" :product="item" />
            </div>
        </div>
    </IndexLyout>
</template>
