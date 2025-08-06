<script setup>

import Slider1 from "@/Pages/Components/Home/Slider1.vue";
import Brands from "@/Pages/Components/Home/Brands.vue";
import {onMounted, ref} from "vue";
import Product from "@/Pages/Components/Home/Product.vue";
import ProductSlider1 from "@/Pages/Components/Home/product-slider1.vue";
import LiveCards from "@/Pages/Components/Home/live-cards.vue";
import Intro from "@/Pages/Components/Home/intro.vue";
import IndexLyout from "@/Pages/IndexLyout.vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const props = defineProps(["indexData"]);
useIndexStore().setSetting(props.indexData.settings);
const slider1Data = ref([
    "../../../../images/slider/slider%20(1).jpeg",
    "../../../../images/slider/slider%20(2).jpeg",
    "../../../../images/slider/slider%20(3).jpeg",
    "../../../../images/slider/slider%20(4).jpeg",
    "../../../../images/slider/slider%20(5).jpeg",
    "../../../../images/slider/slider%20(6).jpeg",
    "../../../../images/slider/slider%20(7).jpeg",
    "../../../../images/slider/slider%20(8).jpeg",
]);
const liveCardData = ref([
    "../../../../images/farm.jpg",
    "../../../../images/fertilizer.jpg",
    "../../../../images/slider/slider%20(7).jpeg",
]);
onMounted(async () => {
    if (useAuthStore().isAuthenticated && useAuthStore().Time + 600000 < Date.now()) {
        useAuthStore().logout();
        await axios.post(route('logout'));
    }
});
</script>

<template>
    <IndexLyout>
        <intro/>
        <slider1 data-aos="fade-up" data-aos-delay="500" :slider1-data="slider1Data"></slider1>
        <!--        brands-->
        <div data-aos="fade-up" class="w-full mx-auto px-4">
            <div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">برندهای</span>
                    <span class="font-black text-defaultColor5">برتر</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <Brands class="w-full" :brands-data="indexData.brands.data"></Brands>
        </div>
        <!--        product show-1-->
        <div data-aos="fade-up" class="w-full mx-auto !transform-none">
            <div class="w-fit !static mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">کود های</span>
                    <span class="font-black text-defaultColor5">تقویتی</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <product-slider1 :products="indexData.products.data" class="w-full"/>
        </div>
        <!--    liveCards-->
        <div data-aos="fade-up" class="w-full mx-auto">
            <div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">اتفاقات</span>
                    <span class="font-black text-defaultColor5">خوب</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-7/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-4/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <div class="mt-6 flex justify-center flex-col items-center gap-2 mx-auto w-full lg:flex-row lg:h-[15rem]">
                <live-cards :image-u-r-l="liveCardData[0]" title="مزرعه"></live-cards>
                <live-cards :image-u-r-l="liveCardData[1]" title="مزرعه"></live-cards>
                <live-cards :image-u-r-l="liveCardData[2]" title="مزرعه"></live-cards>
            </div>
        </div>
        <!--   special product list-->
        <div data-aos="fade-up" class="w-full mx-auto gap-4 flex flex-col !transform-none">
            <div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">محصولات</span>
                    <span class="font-black text-defaultColor5">برتر</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <div class="grid grid-cols-minmaxfill gap-4 justify-center mx-auto w-full">
                <product v-for="item in indexData.products.data" :product="item" :special="true"/>
            </div>
        </div>
    </IndexLyout>

</template>
