<script setup>

import SvgComponent from "@/Components/svg-component.vue";
</script>

<template>
    <div class="w-screen bg-defaultColor7 flex justify-center items-center rounded-t-full overflow-hidden">
        <div class="w-[80rem] py-10 flex items-center justify-center">
            <div class="flex flex-col gap-2 ">
                <div class="flex duration-300 text-white justify-center items-center cursor-pointer gap-2 border-b-2 border-defaultColor5">
                    <img src="../../../../public/logo/logo1.png" alt="جوانه سبز" class="size-10">
                    <h3 class="">جوانه سبز</h3>
                </div>
                <div class="flex duration-300 text-white items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">
                    <svg-component name="about" class="size-5"></svg-component>
                    <h3 class="">درباره ما</h3>
                </div>
                <div class="flex duration-300 text-white items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">
                    <a rel="stylesheet" href="tel:09123456789"><svg-component name="tell" title="09123456789" class="size-5"></svg-component></a>
                    <h3 class="">تماس با ما</h3>
                </div>
                <div class="flex"></div>
            </div>
        </div>
    </div>
</template>
