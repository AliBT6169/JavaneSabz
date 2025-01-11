<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import Slider1 from "@/Pages/Components/Slider1.vue";
import Brands from "@/Pages/Components/Brands.vue";
import {ref} from "vue";
import Product from "@/Pages/Components/Product.vue";
import ProductSlider1 from "@/Pages/Components/product-slider1.vue";
import Navigation from "@/Pages/Components/navigation.vue";
import LiveCards from "@/Pages/Components/live-cards.vue";
import Intro from "@/Pages/Components/intro.vue";

const slider1Data = ref([
    "../../../../images/slider/fertilizer-in-farm.jpg",
    "../../../../images/slider/pesticide-1.webp",
    "../../../../images/slider/strawberry-farm.jpg",
    "../../../../images/farm.jpg",
    "../../../../images/fertilizer.jpg",
    "../../../../images/tootfarangi.jpg",
]);
const brandsData = ref([
    "../../../../images/brands/advanced-nutrients.webp",
    "../../../../images/brands/ardin.webp",
    "../../../../images/brands/argeto.webp",
    "../../../../images/brands/ariashimi.webp",
    "../../../../images/brands/asia-seed.webp",
    "../../../../images/brands/baghbantak.webp",
    "../../../../images/brands/barenbrug.webp",
    "../../../../images/brands/behcam.webp",
    "../../../../images/brands/biobizz.webp",
    "../../../../images/brands/continental-semences.webp",
]);
const productData = ref("../../../../images/products/Emamectin.jpg");
const liveCardData = ref([
    "../../../../images/farm.jpg",
    "../../../../images/fertilizer.jpg",
    "../../../../images/slider/pesticide-1.webp",
]);
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <intro></intro>
        <Header></Header>
        <navigation></navigation>
        <slider1 :slider1-data="slider1Data"></slider1>
<!--        brands-->
        <div class="w-full mx-auto px-4">
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
            <Brands class="w-full" :brands-data="brandsData"></Brands>
        </div>
<!--        product show-1-->
        <div class="w-full mx-auto">
            <div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">کود های</span>
                    <span class="font-black text-defaultColor5">تقویتی</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <product-slider1 class="w-full"></product-slider1>
        </div>
        <!--    liveCards-->
        <div class="w-full mx-auto">
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
        <div class="w-full mx-auto gap-4 flex flex-col">
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
                <product :image="productData" name="امامکتین بنزوات" :special="true" v-for="item in 15"></product>
            </div>
        </div>
        <Footer class="mt-10"></Footer>
    </div>

</template>
