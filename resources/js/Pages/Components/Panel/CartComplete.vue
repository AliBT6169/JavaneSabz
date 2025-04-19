<script setup>

const props = defineProps(["CompleteModal", "productCompletionData"]);
const emit = defineEmits(["updateCompleteModal"])
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div v-if="CompleteModal" class="fixed z-50 flex items-center justify-center size-full top-0 left-0 bg-black/50"
         @click.self="emit('updateCompleteModal')">
        <div class="w-72 h-2/3 py-5 bg-defaultColor5 text-sm rounded-2xl overflow-hidden sm:text-base md:flex dark:bg-cover
         dark:bg-defaultColor md:w-80 lg:w-96">
            <div class="overflow-y-scroll h-full w-full no-scrollbar space-y-10 p-5 *:text-nowrap *:flex
             *:justify-between *:items-center">
                <div class="">
                    <div class="">{{ (productCompletionData.total_amount).toLocaleString('fa-IR') }} تومان</div>
                    <Link href="" class="px-4 py-1 rounded-tr-full rounded-bl-full border bg-gradient-to-l from-yellow-300 to-defaultColor5
                     duration-500 hover:shadow-inner hover:grayscale-[15%] dark:from-defaultColor dark:to-defaultColor5
                   hover:shadow-gray-600"> صفحه پرداخت
                    </Link>
                </div>
                <div class="">
                    <input type="text" class="focus:ring-defaultColor border-none focus:outline-none w-36 rounded-xl dark:placeholder-white
                     dark:focus:ring-defaultColor2 dark:bg-gray-600" placeholder="کد تخفیف:">
                    <input type="button" class="border bg-defaultColor px-4 py-1 cursor-pointer rounded-tr-full rounded-bl-full duration-500
                    hover:shadow-inner hover:grayscale-[15%] hover:shadow-gray-600 dark:bg-defaultColor5"
                           value="اعمال تخفیف ">
                </div>
                <div class="" v-for="item in productCompletionData.products.products">
                    <div class="">{{ item.name + ' : ' + item.value + ' x' + item.quantity }}</div>
                    <div class="">{{ (item.price).toLocaleString('fa-IR') }}</div>
                </div>
                <div class="">
                    <div class="">هزینه ارسال :</div>
                    <div class="">{{ (productCompletionData.delivery_amount.deliveryAmount).toLocaleString('fa-IR') }}
                    </div>
                </div>
                <div class="">
                    <div class="">مالیات9% :</div>
                    <div class="">{{ (productCompletionData.VAT).toLocaleString('fa-IR') }}</div>
                </div>
                <div class="border-t-2 pt-5">
                    <div class="">مبلغ قابل پرداخت :</div>
                    <div class="">{{ (productCompletionData.total_amount).toLocaleString('fa-IR') }}</div>
                </div>

            </div>
        </div>
    </div>
</template>
