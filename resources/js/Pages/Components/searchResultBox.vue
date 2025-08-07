<script setup>

import {useSearchStore} from "@/Pages/Components/Helper/searchStore.js";
import Product from "@/Pages/Components/Home/Product.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {ref} from "vue";
import {Link} from '@inertiajs/vue3'

const searchData = ref(useSearchStore());
</script>

<template>
    <div tabindex="0" class="w-full p-2 absolute top-60 opacity-0 duration-300 z-30 border border-defaultColor/50
                     bg-defaultColor5/80 rounded-xl invisible peer-focus:opacity-100 peer-focus:top-12 peer-focus:visible
                      focus:opacity-100 focus:top-12 focus:visible dark:bg-defaultColor/80 dark:hover:bg-defaultColor
                       hover:bg-defaultColor5 dark:border-defaultColor5/50 md:py-20 sm:w-[135%] md:w-[80vw] xl:w-[150%]
                        xl:right-[-25%] md:right-[-20vw] lg:right-[-25vw]">
        <div v-if="searchData.ProductsToShow!==null"
             class="flex gap-10 flex-wrap justify-center items-center px-1 md:px-5">
            <Product class="w-32 md:w-40 hidden sm:block" v-for="item in searchData.ProductsToShow"
                     :product="item"/>
            <Link :href="route('searchPage')" @mousedown="(e)=>e.target.click()">
                <div
                     class="flex gap-1 items-center justify-center h-fit w-full md:w-48 text-xs p-4 rounded-lg border border-white/50 bg-defaultColor/50
                      duration-300 cursor-pointer hover:scale-95 hover:shadow-sm hover:shadow-gray-600 dark:bg-defaultColor5/50">
                    <strong class="hidden sm:block">
                        مشاهده
                        {{ searchData.allProducts.length - searchData.ProductsToShow.length }} محصول
                        دیگر
                    </strong>
                    <strong class="sm:hidden">
                        همه
                        {{ searchData.allProducts.length }}
                        محصول
                    </strong>
                    <svg-component name="next" class="size-4"/>
                </div>
            </Link>
        </div>
        <div v-else class="text-center text-lg">
            هیچ محصولی یافت نشد!
        </div>
    </div>
</template>
