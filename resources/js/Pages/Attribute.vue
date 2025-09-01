<script setup>
import IndexLyout from "@/Pages/IndexLyout.vue";
import ProductSlider1 from "@/Pages/Components/Home/product-slider1.vue";
import Product from "@/Pages/Components/Home/Product.vue";
import {Carousel, Slide} from "vue3-carousel";
import Brands from "@/Pages/Components/Home/Brands.vue";
import Categories from "@/Pages/Components/Home/Categories.vue";

const props = defineProps({
    data: {type: Object},
});
console.log(props.data)


</script>

<template>
    <IndexLyout>
        <div data-aos="fade-up" v-if="data.allProducts.data.length>0" class="w-full mx-auto space-y-10 !transform-none">
            <div class="w-fit !static mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">محصولات</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-full rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <product-slider1 :products="data.allProducts.data" class="w-full"/>
            <div class="overflow-x-scroll no-scrollbar pb-10" v-if="data.products.data.length>0">
                <div class="w-fit flex items-center gap-6">
                    <div v-for="item in data.products.data" class="flex items-center gap-6">
                        <Product v-for="product in item.variations" :product="product"/>
                    </div>
                </div>
            </div>
        </div>
        <div data-aos="fade-up" v-if="data.brands.data" class="w-full mx-auto px-4">
            <div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">برندها</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-full rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <Brands class="w-full" :brands-data="data.brands.data"/>
        </div>
        <div data-aos="fade-up" v-if="data.brands.data" class="w-full mx-auto px-4">
            <div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">دسته بندی ها</span>
                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-full rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <Categories class="w-full" :categories-data="data.categories.data"/>
        </div>


    </IndexLyout>
</template>
