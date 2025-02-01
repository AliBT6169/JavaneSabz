<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps(["payment"])
</script>

<template>
    <div class="space-y-2 duration-500 shadow-md shadow-gray-500 w-60 p-4 rounded-xl border-2 border-defaultColor h-96 overflow-scroll
      dark:border-darkColor1 sm:w-96 hover3D-animation hover:shadow-red-500 dark:bg-defaultColor7">
        <div class="space-y-4 sticky bg-defaultColor5 top-0 dark:bg-defaultColor7">
            <div class="flex gap-6 text-[8px] text-nowrap sm:text-sm">
                <div class="">در حال تائید</div>
                <div class="">در حال آماده سازی</div>
                <div class="">کالا ارسال شده</div>
            </div>
            <div class="flex justify-center items-center">
                <div class="size-5 p-1 rounded-full bg-defaultColor" :class="{'!bg-blue-500':payment.level>=1}">
                    <svg-component v-if="payment.level>=1" name="check" class="-mt-2 -mr-2 size-5"></svg-component>
                </div>
                <div class="w-16 h-0.5 rounded-full bg-black sm:w-32"></div>
                <div class="size-5 rounded-full bg-defaultColor" :class="{'!bg-blue-500':payment.level>=2}">
                    <svg-component v-if="payment.level>=2" name="check" class="-mt-2 -mr-2 size-5"></svg-component>
                </div>
                <div class="w-16 h-0.5 rounded-full bg-black sm:w-32"></div>
                <div class="size-5 rounded-full bg-defaultColor" :class="{'!bg-blue-500':payment.level===3}">
                    <svg-component v-if="payment.level===3" name="check" class="-mt-2 -mr-2 size-5"></svg-component>
                </div>
            </div>
        </div>
        <div class="space-y-2" v-for="item in payment.product">
            <div class="flex gap-2 items-center">
                <img :src="item.picture" alt=""
                     class="w-14 border-red-500 border-2 rounded-full sm:w-16 md:!w-20">
                <div class="grid gap-1 text-xs sm:text-sm">
                    <strong class="">{{ item.name }}</strong>
                    <div class="">تعداد: <span>{{ item.count }}</span></div>
                    <div class="">قیمت: <span>{{ (item.price).toLocaleString('fa-IR') }}</span></div>
                </div>
            </div>
            <div class="bg-defaultColor7 w-full rounded-full h-0.5"></div>
        </div>
    </div>

</template>
