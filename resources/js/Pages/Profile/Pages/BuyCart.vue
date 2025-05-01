<script setup>

import PanelCartItems from "@/Pages/Components/Panel/PanelCartItems.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";
import CartComplete from "@/Pages/Components/Panel/CartComplete.vue";

const cartCompleteModal = ref(false);
const productCompletionData = ref();
const Products = ref(useAuthStore().Products);
const goToPayPage = async () => {
    if (await useAuthStore().orderMaker()) {
        Products.value = useAuthStore().Products
        cartCompleteModal.value = true;
    }
}
const completeCart = () => {
    useAuthStore().orderMaker();
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
        <button @click="goToPayPage" class="p-2 rounded-full text-center duration-300 border-2 bg-defaultColor
            hover:!bg-opacity-70 dark:bg-defaultColor5">تکمیل پرداخت
        </button>
    </div>
    <div class="grid gap-4">
        <PanelCartItems v-for="(item , index) in Products" :product="item" :index="index"
                        :key="Products.length + index"></PanelCartItems>
    </div>
    <CartComplete :CompleteModal="cartCompleteModal" :productCompletionData="useAuthStore().Orders[0]"
                  @updateCompleteModal="cartCompleteModal = false"/>
</template>
