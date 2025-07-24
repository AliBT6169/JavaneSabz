<script setup>
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {useWindowSize} from "@vueuse/core";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const dashboard = useAuthStore();
const props = defineProps(["product", "index"]);
</script>

<template>
    <div v-if="product.quantity >= 0" class="w-full max-w-96 m-auto pb-4 *:m-auto border-2 rounded-xl border-current *:text-center space-y-2
    sm:flex sm:items-center sm:gap-4 sm:pl-2 sm:p-0 sm:max-w-full sm:max-h-80">
        <div class="w-full rounded-lg cursor-pointer overflow-hidden relative sm:max-w-48">
            <img :src="product.image" :alt="product.name" class="duration-300 hover:scale-110">
            <div class="absolute p-1 rounded-lg bg-white/50 w-fit max-w-full right-2 top-[80%]">
                {{ product.name + ' : ' + product.value }}
            </div>
        </div>
        <p class="w-11/12">
            {{
                product.description.length > useWindowSize().width.value / 5 ? product.description.substring(0, useWindowSize().width.value / 5) + '...' : product.description
            }}</p>
        <div class="w-11/12 space-y-4 *:flex *:justify-between *:items-center sm:w-fit *:lg:block *:lg:space-y-2">
            <div class="lg:!flex !items-end gap-2">
                <div class="">
                    <div class="">تعداد:</div>
                    <div
                        class="mr-4 !overflow-hidden *:px-2 border-black text-lg font-bold border rounded-xl dark:border-white">
                <span @click="dashboard.productIncrement(index ,product.id)"
                      class=" cursor-pointer bg-defaultColor dark:bg-defaultColor5 bg-opacity-80">+</span>
                        <span>{{ product.quantity }}</span>
                        <span
                            @click="product.quantity>0?dashboard.productDecrement(index ,product.id):dashboard.deleteItemFromCart(index ,product.id)"
                            class="cursor-pointer bg-red-600 bg-opacity-80">-</span>
                    </div>
                </div>
                <div @click="dashboard.deleteItemFromCart(index, product.id)" class="p-1 size-fit border rounded-lg bg-red-500/50 border-red-700">
                    <svg-component name="delete" class="size-5 text-red-700"/>
                </div>
            </div>
            <div class="">
                <div>قیمت:</div>
                <div
                    class="py-1 px-2 rounded-full bg-defaultColor/50 dark:bg-defaultColor5/50 border">{{
                        (product.price).toLocaleString('fa-IR')
                    }}
                </div>
            </div>
        </div>
    </div>
</template>
