<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {ref} from "vue";

defineProps(["transactionData"]);
const description = ref(false);
</script>

<template>
    <div class="w-full p-2 rounded-lg border border-gray-500 bg-defaultColor3 text-xs lg:text-base">
        <div class="flex items-center justify-between">
            <!--            success-->
            <div class="bg-defaultColor5 bg-opacity-70 p-2 rounded-full"
                 :class="{'bg-red-500':transactionData.status==='ناموفق'}">{{ transactionData.status }}
            </div>
            <span class="h-8 bg-slate-400 rounded-full w-0.5"></span>
            <p class="w-32 hidden overflow-hidden text-ellipsis text-nowrap md:block lg:w-80 xl:!w-[40rem]">
                <strong class="">محصولات:</strong>
                {{ transactionData.description }}
            </p>
            <!--            date & time-->
            <div class="p-2 rounded-full border">{{transactionData.date}}</div>
            <!--            price-->
            <div
                class="rounded-full border border-amber-300 p-2 text-yellow-500 bg-amber-400 bg-opacity-50 *:pl-1 dark:bg-opacity-50 dark:text-white">
                <span>{{transactionData.price}}</span>تومان
            </div>
            <!--            show more button-->
            <svg-component @click="description=!description" name="arrow-left"
                           :class="{'rotate-[270deg]': description}"
                           class="size-5 duration-300 text-defaultColor4 cursor-pointer"></svg-component>
        </div>
        <div class="grid duration-300 h-0 overflow-hidden" :class="{'h-32 overflow-y-scroll pt-2':description}">
            <p class="">
                <strong class="">محصولات:</strong>
                علف کش , بوته توت فرنگی ,بذر خیار,علف کش , بوته توت فرنگی ,بذر خیار,علف کش , بوته توت فرنگی ,بذر
                خیار,علف کش , بوته توت فرنگی ,بذر خیار,
            </p>
            <div class="flex"></div>
            <div class="flex"></div>
        </div>
    </div>
</template>
