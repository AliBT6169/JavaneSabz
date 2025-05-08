<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";

import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const props = defineProps(["Order"])
const coupon_code = ref('');
console.log(props.Order.status)
</script>

<template>
    <div class="space-y-2 duration-500 shadow-md shadow-gray-500 w-60 p-4 rounded-xl border-2 no-scrollbar border-defaultColor h-96 overflow-y-scroll
      dark:border-darkColor1 sm:w-96 hover3D-animation hover:shadow-red-500 dark:bg-defaultColor7">
        <div v-if="Order.status >= 0" class="space-y-4 sticky bg-defaultColor5 py-4 -top-4 dark:bg-defaultColor7">
            <div class="flex gap-6 text-[8px] text-nowrap sm:text-sm">
                <div class="">در حال تائید</div>
                <div class="">در حال آماده سازی</div>
                <div class="">کالا ارسال شده</div>
            </div>
            <div class="flex justify-center items-center">
                <div class="size-5 p-1 rounded-full bg-defaultColor" :class="{'!bg-blue-500':Order.status>=0}">
                    <svg-component v-if="Order.status=0" name="check" class="-mt-2 -mr-2 size-5"></svg-component>
                </div>
                <div class="w-16 h-0.5 relative rounded-full bg-black sm:w-32"
                     :class="{'bg-blue-500':Order.status>=0}"></div>
                <div class="size-5 rounded-full bg-defaultColor" :class="{'!bg-blue-500':Order.status>=1}">
                    <svg-component v-if="Order.status>=1" name="check" class="-mt-1 -mr-1 size-5"></svg-component>
                </div>
                <div class="w-16 h-0.5 rounded-full bg-black sm:w-32" :class="{'!bg-blue-500':Order.status>=1}"></div>
                <div class="size-5 rounded-full bg-defaultColor" :class="{'!bg-blue-500':Order.status===2}">
                    <svg-component v-if="Order.status===2" name="check" class="-mt-1 -mr-1 size-5"></svg-component>
                </div>
            </div>
        </div>
        <div v-else
             class="w-full bg-blue-500/50 px-2 py-1 rounded-xl border space-y-1 *:w-fit *:m-auto sm:flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <div class="relative">
                    در انتظار پرداخت
                </div>
                <svg-component name="loading" class="size-8"></svg-component>
            </div>
            <Link :href="route('paymentPage',{'order_id':Order.id})" class="block px-4 text-sm py-1 rounded-tr-full rounded-bl-full border bg-gradient-to-l from-yellow-300 to-defaultColor5
                     duration-500 hover:shadow-inner hover:grayscale-[15%] dark:from-defaultColor dark:to-defaultColor5
                   hover:shadow-gray-600"> صفحه پرداخت
            </Link>
        </div>
        <div class="bg-white/50 rounded-xl p-2 space-y-6
*:flex *:justify-between *:items-center">
            <div class="">
                <div class="">جمع قیمت:</div>
                <div class="">{{ Order.price.toLocaleString('fa-IR') }}</div>
            </div>
            <div class="">
                <div class="">هزینه ارسال:</div>
                <div class="">{{ Order.delivery_amount.toLocaleString('fa-IR') }}</div>
            </div>
            <div v-if="Order.coupon_amount" class="">
                <div class="">تخفیف:</div>
                <div class="">{{ Order.coupon_amount.toLocaleString('fa-IR') }}-</div>
            </div>
            <div v-else-if="Order.status===-1" class="text-sm">
                <input type="text" v-model="coupon_code"
                       class="w-28 h-8 rounded-xl dark:bg-gray-600 focus:ring-0 border-none" placeholder="کد تخفیف:">
                <div @click="useAuthStore().coupon_checker(coupon_code,Order.id)" class="border cursor-pointer rounded-xl bg-blue-500 py-1 px-2 duration-300 hover:shadow-inner hover:shadow-gray-600
hover:grayscale-[15%]">اعمال تخفیف %
                </div>
            </div>
            <div class="border-b pb-2">
                <div class="">مالیات %9:</div>
                <div class="">{{ (Order.VAT).toLocaleString('fa-IR') }}</div>
            </div>
            <div class="">
                <div class="">مبلغ قابل پرداخت:</div>
                <div class="">{{ Order.paying_amount.toLocaleString('fa-IR') }}</div>
            </div>
        </div>
        <div class="space-y-2" v-for="item in Order.items">
            <div class="flex gap-2 items-center">
                <img :src="item.image" :alt="item.name"
                     class="w-14 border-red-500 border-2 rounded-full sm:w-16 md:!w-20">
                <div class="grid gap-1 text-xs sm:text-sm">
                    <p class="w-32 text-wrap">{{ item.name + ' : ' + item.value }}</p>
                    <div class="">تعداد: <span>{{ item.quantity }}</span></div>
                    <div class="">قیمت: <span>{{ (item.price).toLocaleString('fa-IR') }}</span></div>
                </div>
            </div>
            <div class="bg-defaultColor7 w-full rounded-full h-0.5"></div>
        </div>
    </div>

</template>
