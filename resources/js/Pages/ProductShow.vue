<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Navigation from "@/Pages/Components/Home/navigation.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(["product"]);
console.log(props.product);
</script>

<template class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
    <Header/>
    <navigation/>
    <div class="space-y-6 py-96">
        <!--        page location-->
        <div class="w-full flex">
            <div class="flex items-center w-fit gap-2 px-4">
                <Link href="/">
                <span
                    class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                </Link>
                <svg-component name="next" class="size-3"></svg-component>
                <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span>
            </div>
        </div>
    </div>
    <Footer/>
</template>
