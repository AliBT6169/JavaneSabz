<script setup>

import {onMounted, ref} from "vue";

const props = defineProps({
    CompleteModal: null,
    productCompletionData: null
});

const emit = defineEmits(["updateCompleteModal"])
import {Link} from "@inertiajs/vue3";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const coupon_code = ref('');

</script>

<template>
    <div v-if="CompleteModal" class="fixed z-50 flex items-center justify-center size-full top-0 left-0 bg-black/50"
         @click.self="emit('updateCompleteModal')">
        <div class="w-72 h-2/3 py-5 border-4 bg-defaultColor5 text-sm rounded-2xl overflow-hidden sm:text-base md:flex dark:bg-cover
         dark:bg-defaultColor md:w-80 lg:w-96">
            <div class="overflow-y-scroll h-full w-full no-scrollbar space-y-10 p-5 *:text-nowrap *:flex
             *:justify-between *:items-center">
                <div class="">
                    <div class="">{{ (productCompletionData.paying_amount).toLocaleString('fa-IR') }} تومان</div>
                    <Link :href="route('paymentPage',{'order_id':productCompletionData.id})" class="px-4 py-1 rounded-tr-full rounded-bl-full border bg-gradient-to-l from-yellow-300 to-defaultColor5
                     duration-500 hover:shadow-inner hover:grayscale-[15%] dark:from-defaultColor dark:to-defaultColor5
                   hover:shadow-gray-600"> صفحه پرداخت
                    </Link>
                </div>
                <div v-if="productCompletionData.coupon_amount===0" class="">
                    <input v-model="coupon_code" type="text" class="focus:ring-defaultColor border-none focus:outline-none w-36 rounded-xl dark:placeholder-white
                     dark:focus:ring-defaultColor2 dark:bg-gray-600" placeholder="کد تخفیف:">
                    <div @click="useAuthStore().coupon_checker(coupon_code)"
                         class="border py-1 px-5 cursor-pointer rounded-tr-full rounded-bl-full duration-500 bg-gradient-to-l from-yellow-300
                     to-defaultColor5 hover:shadow-inner hover:grayscale-[15%] dark:from-defaultColor dark:to-defaultColor5 hover:shadow-gray-600">
                        اعمال تخفیف
                    </div>
                </div>
                <div v-else class="flex items-center justify-between">
                    <div class="">تخفیف :</div>
                    <div class="">{{ (productCompletionData.coupon_amount).toLocaleString('fa-IR') }}
                    </div>
                </div>
                <div class="" v-for="item in productCompletionData.items">
                    <div class="">{{ item.name + ' : ' + item.value + ' x' + item.quantity }}</div>
                    <div class="">{{ (item.price).toLocaleString('fa-IR') }}</div>
                </div>
                <div class="">
                    <div class="">هزینه ارسال :</div>
                    <div class="">{{ (productCompletionData.delivery_amount).toLocaleString('fa-IR') }}
                    </div>
                </div>
                <div class="">
                    <div class="">مالیات9% :</div>
                    <div class="">{{ (productCompletionData.VAT).toLocaleString('fa-IR') }}</div>
                </div>
                <div class="border-t-2 pt-5">
                    <div class="">مبلغ قابل پرداخت :</div>
                    <div class="">{{ (productCompletionData.paying_amount).toLocaleString('fa-IR') }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
