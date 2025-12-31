<script setup lang="ts">
import {ref} from 'vue';
import IndexLyout from "@/Pages/IndexLyout.vue";

const props = defineProps({
    payment_amount: {
        type: Number,
    },
    order_id: {
        type: Number,
    },
})
const isProcessing = ref(false);

const handlePayment = () => {
    isProcessing.value = true;
    window.location.replace(route('ZibalPayPage', {order_id: props.order_id}))
};
</script>

<template>
    <IndexLyout>
        <div
            class="min-h-[60vh] flex items-center justify-center p-4 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

            <!-- کارت اصلی -->
            <div
                class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden text-center p-8 space-y-6">

                <!-- آیکون و هدر -->
                <div class="flex flex-col items-center space-y-4">
                    <div
                        class="w-20 h-20 rounded-full bg-[#85A947]/10 dark:bg-[#1A4D2E]/30 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-10 h-10 text-[#85A947] dark:text-[#6fcf97]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        تایید و پرداخت نهایی
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        شما در حال انتقال به درگاه پرداخت امن بانکی هستید.
                    </p>
                </div>

                <!-- باکس مبلغ (اختیاری ولی برای اطمینان کاربر عالی است) -->
                <div
                    class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-dashed border-gray-200 dark:border-gray-600">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-300 text-sm">مبلغ قابل پرداخت:</span>
                        <div class="flex items-baseline gap-1">
                            <span
                                class="text-xl font-bold text-[#85A947] dark:text-[#4ade80]">{{ payment_amount.toLocaleString() }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">تومان</span>
                        </div>
                    </div>
                </div>

                <!-- دکمه پرداخت -->
                <button
                    @click="handlePayment"
                    :disabled="isProcessing"
                    class="group relative w-full flex items-center justify-center py-3.5 px-6 rounded-xl text-white font-medium shadow-lg shadow-[#85A947]/30 transition-all duration-300 hover:shadow-[#85A947]/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#85A947] disabled:opacity-70 disabled:cursor-not-allowed"
                    :class="isProcessing ? 'bg-gray-400' : 'bg-[#85A947] hover:bg-[#72913a] dark:bg-[#1A4D2E] dark:hover:bg-[#143d24]'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                    <span v-if="!isProcessing" class="flex items-center gap-2">
                        پرداخت آنلاین
                    </span>

                    <!-- لودینگ اسپینر -->
                    <span v-else class="flex items-center gap-2">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        در حال اتصال...
                    </span>
                </button>

                <!-- فوتر اطمینان -->
                <div class="flex justify-center items-center gap-2 text-xs text-gray-400 dark:text-gray-500 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4 text-[#85A947] dark:text-[#6fcf97]">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>پرداخت امن با پروتکل SSL</span>
                </div>

            </div>
        </div>
    </IndexLyout>
</template>
