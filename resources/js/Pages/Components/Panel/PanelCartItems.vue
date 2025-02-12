<script setup>
import {onMounted, ref} from "vue";
import {productCountDecrement, productCountIncrement} from "@/Pages/Profile/DashboardContainer.js";
import Product from "@/Pages/Components/Home/Product.vue";

const props = defineProps(["product","index"]);
const productCount = ref(props.product.count)
console.log(props.product)
</script>

<template>
    <div v-if="product.quantity>0" class="grid select-none shadow-md duration-300 shadow-slate-600 place-items-center place-self-center gap-4 w-fit
        py-2 px-4 rounded-xl border-2 border-defaultColor dark:border-defaultColor5 hover:shadow-lg hover:shadow-slate-600
        sm:flex xl:w-full xl:justify-between">
        <div class="w-40 rounded-lg cursor-pointer overflow-hidden">
            <img :src="product.image" :alt="product.name" class="duration-300 hover:scale-110">
        </div>
        <span class="w-20">{{product.name.length>25?product.name.substring(0,25)+'...':product.name}}</span>
        <p class="w-32">{{ product.description.length > 50 ? product.description.substring(0, 50) + '...' : product.description}}</p>
        <div class="flex items-center gap-1">تعداد:
            <div
                class="mr-4 !overflow-hidden *:px-2 border-black text-lg font-bold border rounded-xl dark:border-white">
                <span @click="[productCountIncrement(index),product.quantity++]"
                      class=" cursor-pointer bg-defaultColor dark:bg-defaultColor5 bg-opacity-80">+</span>
                <span>{{ product.quantity }}</span>
                <span @click="product.quantity>0?[productCountDecrement(index),product.quantity--]:product.quantity"
                      class="cursor-pointer bg-red-600 bg-opacity-80">-</span>
            </div>
        </div>
        <div class="*:px-2"><span>قیمت:</span> <span>{{product.price}}</span></div>
    </div>
</template>
