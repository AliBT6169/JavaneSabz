<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {ref} from "vue";

const props = defineProps(["transactionData"]);
const descriptionStatus = ref(false);
</script>

<template>
    <div class="w-full p-2 rounded-lg border border-gray-500 bg-defaultColor3 text-xs lg:text-base">
        <div class="flex items-center justify-between">
            <!--            success-->
            <div v-if="transactionData.status===0" class="bg-red-500 bg-opacity-70 p-2 rounded-full">ناموفق</div>
            <div v-if="transactionData.status===1" class="bg-yellow-500 bg-opacity-70 p-2 rounded-full">نامعلوم</div>
            <div v-if="transactionData.status===2" class="bg-defaultColor5 bg-opacity-70 p-2 rounded-full">موفق</div>
            <span class="h-8 bg-slate-400 rounded-full w-0.5"></span>
            <p class="w-32 hidden overflow-hidden text-ellipsis text-nowrap md:block lg:w-80 xl:!w-[40rem]">
                <strong class="">محصولات:</strong>
                <span v-for="item in transactionData.products" class="">{{ item.name + ' , ' }}</span>
            </p>
            <!--            date & time-->
            <div class="p-2 rounded-full border">{{ transactionData.date }}</div>
            <!--            price-->
            <div
                class="rounded-full border border-amber-300 p-2 text-yellow-500 bg-amber-400 bg-opacity-50 *:pl-1 dark:bg-opacity-50 dark:text-white">
                <span>{{ transactionData.price.toLocaleString('fa-IR') }}</span>تومان
            </div>
            <!--            show more button-->
            <svg-component @click="descriptionStatus=!descriptionStatus" name="arrow-left"
                           :class="{'rotate-[270deg]': descriptionStatus}"
                           class="size-5 duration-300 text-defaultColor4 cursor-pointer"></svg-component>
        </div>
        <div class="grid duration-300 h-0 overflow-hidden" :class="{'h-32 overflow-y-scroll pt-2':descriptionStatus}">
            <p class="">
                <strong class="">محصولات:</strong>
                <span v-for="item in transactionData.products" class="">{{ item.name + ' , ' }}</span>
            </p>
        </div>
    </div>
</template>
