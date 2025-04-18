<script setup>

import PanelCartItems from "@/Pages/Components/Panel/PanelCartItems.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";

const cartCompleteModal = ref(false);

const Products = ref(useAuthStore().Products);
const productCompletionData = ref();
const goToPayPage = () => {
    useAuthStore().CartCompleter();
}
const cacheDeliveryAmount = async () => {
    await axios.get(route('BuyCart.completePayment')).then(res => {
        console.log(res.data)
        if (res.data.status === 100)
            useAuthStore().toastMessage('error', res.data.message);
        else productCompletionData.value = res.data;
    }).catch(err => {
        console.log(err);
    });
}

</script>

<template>
    <div class="mb-4 px-4 py-2 rounded-lg bg-defaultColor2 border grid gap-2 text-white sm:flex
         sm:items-center sm:justify-between sm:rounded-full">
        <div class="flex justify-between">
            <span> تعداد محصولات : </span><span>{{
                Products.reduce((accumulator, item) => accumulator + item.quantity, 0)
            }}</span>
        </div>
        <div class="flex justify-between">
            <span>جمع مبلغ :</span><span>{{
                (Products.reduce((accumulator, item) => accumulator + item.price * item.quantity, 0)).toLocaleString('fa-IR')
            }}</span>
        </div>
        <button @click="()=>{cartCompleteModal = true; cacheDeliveryAmount()}" class="p-2 rounded-full text-center duration-300 border-2 bg-defaultColor
            hover:!bg-opacity-70 dark:bg-defaultColor5">تکمیل پرداخت
        </button>
    </div>
    <div class="grid gap-4">
        <PanelCartItems v-for="(item , index) in Products" :product="item" :index="index"></PanelCartItems>
    </div>
    <div v-if="cartCompleteModal" class="fixed z-50 flex items-center justify-center size-full top-0 left-0 bg-black/50"
         @click.self="cartCompleteModal = false">
        <div class="w-72 h-2/3 bg-defaultColor5 text-sm rounded-2xl overflow-hidden sm:text-base md:flex dark:bg-cover dark:bg-defaultColor">
            <div class="overflow-y-scroll h-full w-full no-scrollbar space-y-10 p-5 *:text-nowrap *:flex
             *:justify-between *:items-center">
                <div class="">
                    <div class="">{{(productCompletionData.total_amount).toLocaleString('fa-IR')}} تومان</div>
                    <Link href="" class="p-2 rounded-xl border bg-defaultColor2 duration-500 hover:shadow-inner hover:grayscale-[15%] hover:shadow-gray-600"> صفحه پرداخت</Link>
                </div>
                <div class="" v-for="item in productCompletionData.products.products">
                    <div class="">{{item.name + ' : ' + item.value + ' x' + item.quantity}}</div>
                    <div class="">{{(item.price).toLocaleString('fa-IR')}}</div>
                </div>
                <div class="">
                    <div class="">هزینه ارسال :</div>
                    <div class="">{{(productCompletionData.delivery_amount.deliveryAmount).toLocaleString('fa-IR')}}</div>
                </div>
                <div class="">
                    <div class="">مالیات9% :</div>
                    <div class="">{{(productCompletionData.VAT).toLocaleString('fa-IR')}}</div>
                </div>
                <div class="border-t-2 pt-5">
                    <div class="">مبلغ قابل پرداخت :</div>
                    <div class="">{{(productCompletionData.total_amount).toLocaleString('fa-IR')}}</div>
                </div>

            </div>
        </div>
    </div>
</template>
