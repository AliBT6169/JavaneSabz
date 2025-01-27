<script setup>

import DarkLight from "@/Pages/Components/DarkLight.vue";
import {Link} from '@inertiajs/vue3'
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {profileSidebar} from "@/Pages/Components/Helper/Helper.js";
</script>

<template>
    <div class="select-none fixed z-10 top-0 right-0 border border-slate-500 w-full py-2 bg-defaultColor5 rounded-full px-10 flex items-center
     justify-between dark:bg-defaultColor">
        <svg-component name="dashboard" class="size-9 cursor-pointer dark:text-white" @click="profileSidebar=!profileSidebar"></svg-component>
        <a href="/" class="">
            <img src="../../../../../public/logo/logo1.png" class="w-14 scale-[1.5]" alt="">
        </a>
        <div class="flex gap-2 items-center">
            <DarkLight></DarkLight>
            <div class="relative group">
                <div class="rounded-xl bg-defaultColor overflow-hidden">
                    <img src="../../../../../public/images/about-us/owner.jpg" class="w-14 rounded-xl" alt="">
                </div>
                <div class="invisible opacity-0 absolute duration-300 pt-4 top-28 left-0
                group-hover:visible group-hover:opacity-100 group-hover:top-14">
                    <div class="rounded-lg w-48 border-2 bg-defaultColor5 p-4 grid gap-4 dark:bg-defaultColor">
                        <!--                        items-->
                        <a href="/" class="">
                            <div class="flex justify-between py-2 cursor-pointer duration-500 items-center
                            border-b hover:text-slate-600 dark:hover:text-gray-300 hover:px-1">
                                <svg-component name="home" class="size-7"></svg-component>
                                <div class="">صفحه اصلی</div>
                            </div>
                        </a>
                        <Link :href="route('logout')" method="post" class="">
                            <div class="flex justify-between py-2 cursor-pointer duration-500 items-center
                             border-b hover:text-slate-600 dark:hover:text-gray-300 hover:px-1">
                                <svg-component name="logout" class="size-6"></svg-component>
                                <div class="">خروج از حساب</div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
