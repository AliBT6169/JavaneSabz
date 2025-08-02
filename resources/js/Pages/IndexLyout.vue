<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Navigation from "@/Pages/Components/Home/navigation.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";

const indexSettings = useIndexStore().Settings.settings.data;
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[48rem] lg:w-[60rem] xl:w-[80rem]">
        <Header :settings="indexSettings"/>
        <navigation :settings="useIndexStore"/>
        <slot/>
        <Footer :settings="indexSettings" class="mt-10"/>
    </div>

</template>
