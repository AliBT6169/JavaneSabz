<script setup>
import {onMounted, ref} from "vue";
import {productCountDecrement, productCountIncrement} from "@/Pages/Profile/DashboardContainer.js";

const props = defineProps(["product","index"]);
const productCount = ref(props.product.count)
</script>

<template>
    <div v-if="productCount>0" class="grid select-none shadow-md duration-300 shadow-slate-600 place-items-center place-self-center gap-4 w-fit
        py-2 px-4 rounded-xl border-2 border-defaultColor dark:border-defaultColor5 hover:shadow-lg hover:shadow-slate-600
        sm:flex xl:w-full xl:justify-between">
        <div class="w-40 rounded-lg cursor-pointer overflow-hidden">
            <img :src="product.picture" alt="Emamectin" class="duration-300 hover:scale-110">
        </div>
        <span class="">{{product.name}}</span>
        <p class="">{{ product.description }}</p>
        <div class="flex items-center gap-1">تعداد:
            <div
                class="mr-4 !overflow-hidden *:px-2 border-black text-lg font-bold border rounded-xl dark:border-white">
                <span @click="[productCountIncrement(index),productCount++]"
                      class=" cursor-pointer bg-defaultColor dark:bg-defaultColor5 bg-opacity-80">+</span>
                <span>{{ productCount }}</span>
                <span @click="productCount>0?[productCountDecrement(index),productCount--]:productCount"
                      class="cursor-pointer bg-red-600 bg-opacity-80">-</span>
            </div>
        </div>
        <div class="*:px-2"><span>قیمت:</span> <span>{{product.price}}</span></div>
    </div>
</template>
