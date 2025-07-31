<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
</script>

<template>
    <div class=" bg-defaultColor7 flex justify-center items-center rounded-t-[8rem] overflow-hidden">
        <div class="w-[80rem] items-center md:items-start md:justify-around flex flex-col text-white md:flex-row">
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
                    <span class="text-defaultColor5">
                        (علیرضا باباتبار)
                    </span>
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
            <div class="flex flex-col gap-2 h-full">
                <div class="flex border-b-2 border-defaultColor5 justify-center items-center">
                    <div class="size-20 flex items-center">
                        <svg-component name="location" class="size-8"></svg-component>
                    </div>
                    <p class="text-xl translate-x-10 font-black">موقعیت مکانی</p>
                </div>
                <div class="">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d205.92511102483456!2d52.77588788202066!3d36.650352865990975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f857d39956460cb%3A0xd35d50893e1ab96f!2z2LPZhdmI2YUg2qnYtNin2YjYsdiy24wg2KzZiNin2YbZhyDYs9io2LIg2LTZhdin2YQ!5e0!3m2!1sen!2s!4v1736097896290!5m2!1sen!2s"
                        width="200" height="150" style="border: none" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="h-28 md:hidden"></div>
        </div>
    </div>
</template>
