<script setup>
import {onMounted, ref} from "vue";
import Product from "@/Pages/Components/Home/Product.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const dashboard = useAuthStore();
const props = defineProps(["product", "index"]);
const productCount = ref(props.product.count)
</script>

<template>
    <div v-if="product.quantity>0" class="w-full *:m-auto border-2 rounded-xl border-current *:text-center space-y-2">
        <div class="w-full rounded-lg cursor-pointer overflow-hidden relative">
            <img :src="product.image" :alt="product.name" class="duration-300 hover:scale-110">
        <div class="absolute p-1 rounded-lg bg-white/50 w-fit max-w-full right-2 top-3/4">{{ product.name + ' : ' + product.value }}</div>
        </div>
        <p class="w-11/12">
            {{
                product.description.length > 100 ? product.description.substring(0, 100) + '...' : product.description
            }}</p>
        <div class="flex w-fit justify-center items-center gap-1">
            <div class="">تعداد:</div>
            <div
                class="mr-4 !overflow-hidden *:px-2 border-black text-lg font-bold border rounded-xl dark:border-white">
                <span @click="dashboard.productIncrement(index ,product.id)"
                      class=" cursor-pointer bg-defaultColor dark:bg-defaultColor5 bg-opacity-80">+</span>
                <span>{{ product.quantity }}</span>
                <span @click="product.quantity>0?dashboard.productDecrement(index ,product.id):product.quantity"
                      class="cursor-pointer bg-red-600 bg-opacity-80">-</span>
            </div>
        </div>
        <div class="*:px-2"><span>قیمت:</span> <span>{{ (product.price).toLocaleString('fa-IR') }}</span></div>
    </div>
</template>
