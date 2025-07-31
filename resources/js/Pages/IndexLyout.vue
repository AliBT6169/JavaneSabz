<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Navigation from "@/Pages/Components/Home/navigation.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import {onMounted, ref} from "vue";

const settings = ref(false);
onMounted(async () => {
    await axios.get(route('settings')).then(res => {
        settings.value = res.data;
    });
});
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[48rem] lg:w-[60rem] xl:w-[80rem]">
        <Header/>
        <navigation/>
        <slot/>
        <Footer v-if="settings!==false" :settings="settings" class="mt-10"/>
    </div>

</template>
