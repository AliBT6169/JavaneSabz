<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps(["Order"])
</script>

<template>
    <div class="space-y-2 duration-500 shadow-md shadow-gray-500 w-60 p-4 rounded-xl border-2 border-defaultColor h-96 overflow-y-scroll
      dark:border-darkColor1 sm:w-96 hover3D-animation hover:shadow-red-500 dark:bg-defaultColor7">
        <div class="space-y-4 sticky bg-defaultColor5 py-4 -top-4 dark:bg-defaultColor7">
            <div class="flex gap-6 text-[8px] text-nowrap sm:text-sm">
                <div class="">در حال تائید</div>
                <div class="">در حال آماده سازی</div>
                <div class="">کالا ارسال شده</div>
            </div>
            <div class="flex justify-center items-center">
                <div class="size-5 p-1 rounded-full bg-defaultColor" :class="{'!bg-blue-500':Order.status>=0}">
                    <svg-component v-if="Order.status>=0" name="check" class="-mt-2 -mr-2 size-5"></svg-component>
                </div>
                <div class="w-16 h-0.5 relative rounded-full bg-black sm:w-32" :class="{'bg-blue-500':Order.status>=0}"></div>
                <div class="size-5 rounded-full bg-defaultColor" :class="{'!bg-blue-500':Order.status>=1}">
                    <svg-component v-if="Order.status>=1" name="check" class="-mt-1 -mr-1 size-5"></svg-component>
                </div>
                <div class="w-16 h-0.5 rounded-full bg-black sm:w-32" :class="{'!bg-blue-500':Order.status>=1}"></div>
                <div class="size-5 rounded-full bg-defaultColor" :class="{'!bg-blue-500':Order.status===2}">
                    <svg-component v-if="Order.status===2" name="check" class="-mt-1 -mr-1 size-5"></svg-component>
                </div>
            </div>
        </div>
        <div class="space-y-2" v-for="item in Order.items">
            <div class="flex gap-2 items-center">
                <img :src="item.image" :alt="item.name"
                     class="w-14 border-red-500 border-2 rounded-full sm:w-16 md:!w-20">
                <div class="grid gap-1 text-xs sm:text-sm">
                    <p class="w-32 text-wrap">{{ item.name }}</p>
                    <div class="">تعداد: <span>{{ item.quantity }}</span></div>
                    <div class="">قیمت: <span>{{ (item.price).toLocaleString('fa-IR') }}</span></div>
                </div>
            </div>
            <div class="bg-defaultColor7 w-full rounded-full h-0.5"></div>
        </div>
    </div>

</template>
