<script setup>

import Product from "@/Pages/Components/Home/Product.vue";
import {LikedProducts} from "@/Pages/Profile/DashboardContainer.js";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const wishList = useAuthStore().WishList
</script>

<template>
    <div class="">
        <div class="mb-4 p-2 rounded-lg bg-defaultColor2 border grid gap-2 text-white
         sm:rounded-full sm:w-full">
            <div class="flex justify-center">
                <span> محصولات مورد علاقه : </span><span>{{
                    wishList.reduce((accumulator, item) => accumulator + 1, 0)
                }}</span>
            </div>
            <div class="flex justify-between">
            </div>
        </div>
        <div class="Sidebar flex justify-center gap-10 flex-wrap">
            <Product v-for="item in wishList" :name="item.product.name" :image="item.product.primary_image"
                     :liked="true"/>
        </div>
    </div>
</template>
