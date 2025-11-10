<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Navigation from "@/Pages/Components/Home/navigation.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import {modalSet} from "@/Pages/Components/Helper/Helper.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref, watch} from "vue";

const indexSettings = ref(useIndexStore().Settings?.settings?.data);

watch(() => useIndexStore().Settings,
    (newVal) => {
        indexSettings.value = newVal.settings?.data
        console.log(indexSettings.value);
    })
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[48rem] lg:w-[60rem] xl:w-[80rem]">
        <div
            class="hidden fixed z-50 bottom-10 rounded-full py-2 px-2.5 animate-bounce bg-defaultColor5 border-4 border-white left-20
            lg:left-40 2xl:left-72 cursor-pointer md:block dark:bg-defaultColor dark:border-black"
            @click="modalSet('BuyCart')">
            <span
                class="absolute top-8 left-8 size-4 text-xs flex justify-center items-center rounded-full bg-red-500 dark:bg-red-700">{{
                    useAuthStore().Products ? useAuthStore().Products.length : ''
                }}</span>
            <p class="mt-1 text-sm">سبد خرید</p>
            <SvgComponent name="cart" class="size-9 m-auto"/>
        </div>
        <Header :settings="indexSettings"/>
        <navigation :settings="indexSettings"/>
        <slot/>
        <Footer :settings="indexSettings" class="mt-10"/>
    </div>

</template>
