<script setup>

import SvgComponent from "@/Components/svg-component.vue";
</script>

<template>
    <div class="w-screen bg-defaultColor7 flex justify-center items-center rounded-t-full overflow-hidden">
        <div class="w-[80rem] justify-around flex text-white">
            <div class="flex flex-col gap-2 h-full">
                <div
                    class="flex duration-300 items-center cursor-pointer gap-2 border-b-2 border-defaultColor5">
                    <img src="../../../../public/logo/logo1.png" alt="جوانه سبز" class="size-20">
                    <h3 class="text-2xl font-black text-defaultColor5">جوانه سبز</h3>
                </div>
                <p class="w-60">
                    فروشگاه جوانه سبز در تلاش است تا بهترین خود را برای کشاورزان محترم بگذارد تا
                    همیشه بتوانند سود خوبی از زمین های زراعی و باغ های خود داشته باشند
                    خاک پای کشاورزان
                    <p class="text-defaultColor5">
                        (علیرضا باباتبار)
                    </p>
                </p>
            </div>
            <div class="flex flex-col gap-2 h-full">
                <div class="flex border-b-2 border-defaultColor5 justify-center items-center">
                    <div class="size-20 flex items-center">
                        <svg-component name="about" class="size-8"></svg-component>
                    </div>
                    <p class="text-xl translate-x-10 font-black">اطلاعات</p>
                </div>
                <div
                    class="flex duration-300 items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">
                    <svg-component name="about" class="size-5"></svg-component>
                    <h3 class="">درباره ما</h3>
                </div>
                <div
                    class="flex duration-300 items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">
                    <a rel="stylesheet" href="tel:09123456789">
                        <svg-component name="tell" title="09123456789" class="size-5"></svg-component>
                    </a>
                    <h3 class="">تماس با ما</h3>
                </div>
                <div class="flex flex-col gap-3">
                    <div
                        class="flex duration-300 items-center gap-2">
                        <svg-component name="connection" class="size-5"></svg-component>
                        <h3 class="">پل های ارتباطی :</h3>
                    </div>
                    <div class="flex gap-2">
                        <svg-component name="telegram" class="footer-connection-svg size-[30px]"></svg-component>
                        <svg-component name="instagram" class="footer-connection-svg size-[30px]"></svg-component>
                        <svg-component name="whatsapp" class="footer-connection-svg size-7"></svg-component>
                        <svg-component name="tell" class="footer-connection-svg size-[30px]"></svg-component>
                    </div>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>
</template>
