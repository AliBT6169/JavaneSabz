<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import Slider1 from "@/Pages/Components/Slider1.vue";
import Brands from "@/Pages/Components/Brands.vue";
import {ref} from "vue";
import Product from "@/Pages/Components/Product.vue";
import ProductSlider1 from "@/Pages/Components/product-slider1.vue";
import Navigation from "@/Pages/Components/navigation.vue";

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
const productData = ref("../../../../images/products/Emamectin.jpg")
</script>

<template class="">
    <Header class="w-[80rem]"></Header>
    <navigation class="w-[80rem]"></navigation>
    <slider1 :slider1-data="slider1Data"></slider1>
    <Brands class="w-[80rem]" :brands-data="brandsData"></Brands>
    <product-slider1 class="w-[80rem]"></product-slider1>
<!--   special product list-->
    <div class="w-[80rem] mx-auto gap-4 mt-10 flex flex-col">
        <div class="w-fit text-4xl">
            <div class="flex gap-2">
                <span class="">محصولات</span>
                <span class="font-black text-defaultColor5">ویژه</span>
            </div>
            <div class="flex gap-2 h-2">
                <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
            </div>
        </div>
        <div class="flex flex-wrap gap-4 items-center">
            <product :image="productData" name="امامکتین بنزوات" :special="true" v-for="item in 15"></product>
        </div>
    </div>
    <Footer class="mt-10"></Footer>
</template>
