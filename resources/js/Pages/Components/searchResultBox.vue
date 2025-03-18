<script setup>

import {useSearchStore} from "@/Pages/Components/Helper/searchStore.js";
import Product from "@/Pages/Components/Home/Product.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {ref} from "vue";
const searchData = ref(useSearchStore());
</script>

<template>
    <div tabindex="0" class="w-[80vw] py-20 absolute top-60 opacity-0 -left-[calc(40vw-50%)] duration-300 z-20 border border-defaultColor/50
                     bg-defaultColor5/80 rounded-xl invisible peer-focus:block peer-focus:opacity-100 peer-focus:top-12 peer-focus:visible
                     focus:block focus:opacity-100 focus:top-12 focus:visible
                    dark:bg-defaultColor/80 dark:hover:bg-defaultColor hover:bg-defaultColor5 dark:border-defaultColor5/50">
        <div v-if="searchData.ProductsToShow!=null" class="flex gap-10 flex-wrap justify-center items-center p-5">
            <Product class="w-32 md:w-40" v-for="item in searchData.ProductsToShow" :product="item"></Product>
            <div class="flex gap-1 items-center justify-center h-fit w-48 text-xs p-4 rounded-lg border border-white/50 bg-defaultColor/50 duration-300 cursor-pointer
             hover:scale-95 hover:shadow-sm hover:shadow-gray-600 dark:bg-defaultColor5/50">
                <strong>
                    مشاهده {{ searchData.allProducts.length - searchData.ProductsToShow.length }} محصول دیگر
                </strong>
                <svg-component name="next" class="size-4"></svg-component>
            </div>
        </div>
    </div>
</template>
