<script setup>

import {useSearchStore} from "@/Pages/Components/Helper/searchStore.js";
import Product from "@/Pages/Components/Home/Product.vue";
</script>

<template>
    <div tabindex="0" class="w-[80vw] py-20 absolute top-60 opacity-0 -left-[calc(40vw-50%)] duration-300 z-20 border border-defaultColor/50
                     bg-defaultColor5/80 rounded-xl invisible peer-focus:block peer-focus:opacity-100 peer-focus:top-12 peer-focus:visible
                     focus:block focus:opacity-100 focus:top-12 focus:visible
                    dark:bg-defaultColor/80 dark:hover:bg-defaultColor hover:bg-defaultColor5 dark:border-defaultColor5/50">
        <div v-if="useSearchStore().Products!=null" class="flex gap-10 flex-wrap justify-center p-5">
            <Product class="w-40" v-for="item in useSearchStore().Products" :product="item"></Product>
        </div>
    </div>
</template>
