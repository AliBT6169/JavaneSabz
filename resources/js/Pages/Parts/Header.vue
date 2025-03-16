<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from '@inertiajs/vue3'
import DarkLight from "@/Pages/Components/Home/DarkLight.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {Modal, ModalComponent, modalSet} from "@/Pages/Components/Helper/Helper.js";

const authUser = useAuthStore();
</script>
<template>
    <header class="w-full">
        <div @click.self="()=>{Modal = false, ModalComponent=null}"
             class="fixed invisible opacity-0 duration-500 z-50 top-0 left-0 p-8 w-screen h-screen bg-gray-700/30 md:p-20"
             :class="{'!visible !opacity-100':Modal}">
            <div :class="{'!translate-x-0':Modal}"
                 class="translate-x-[100vw] duration-500 w-2-3 p-6 h-full overflow-y-auto bg-defaultColor5 rounded-xl modal dark:bg-defaultColor">
                <component class="modal" :is="ModalComponent"></component>
            </div>
        </div>
        <div class="w-fit flex z-20 flex-col mx-auto items-center justify-center
         md:flex-row md:w-full md:justify-between">
            <!--            icon-->
            <div class="flex items-center gap-1 justify-center">
                <Link href="/" class="">
                    <img src="../../../../public/logo/logo1.png" class="w-24 h10" alt="">
                </Link>
                <div class="w-2 h-8 border-gray-300 border-r-2"></div>
                <div class="flex gap-1 flex-col">
                    <div class="font-[1000] text-[1rem] dark:text-slate-100"><span class="hidden lg:inline-block">فروشگاه </span>
                        محصولات کشاورزی جوانه سبز
                    </div>
                    <div class=" text-slate-500 text-xs dark:text-slate-300">دوست مهربان کشاورز ها</div>
                </div>
            </div>
            <!--            search box-->
            <div class="xl:w-[20rem] hidden lg:block">
                <div class="relative w-fit">
                    <input type="text" @input="(e)=>console.log(e.target.value)"
                           class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor xl:w-[20rem] sm:[200px] w-[250px] md:w-[150px] h-10 rounded-2xl bg-gray-50 border-gray-200 dark:bg-gray-600 dark:focus:border-defaultColor5 dark:text-gray-100
                                 text-xs lg:text-sm" placeholder="جستجوی محصول">
                    <div class="absolute top-2.5 left-2 cursor-pointer text-slate-200">
                        <svg-component name="search" class="size-5"></svg-component>
                    </div>
                </div>
            </div>
            <div class="gap-2 hidden md:flex">
                <!--                        buy cart-->
                <div @click="modalSet('BuyCart')"
                     class="modal w-fit px-4 shine_animation h-10 rounded-bl-sm rounded-3xl bg-defaultColor flex shadow-sm
                    gap-2 justify-center items-center">
                    <div class="text-defaultColor4">
                        <svg-component name="cart" class="size-5"></svg-component>
                    </div>
                    <div class="text-xs text-nowrap text-white block">سبد خرید</div>
                    <div v-if="authUser.isAuthenticated" class="px-2 py-1 mt-0.5 bg-slate-300 rounded-full dark:text-slate-800 text-xs">{{authUser.Products.length}}</div>
                </div>
                <!--            login and register-->
                <Link :href="route(useAuthStore().user === null ?'login':'dashboard')">
                    <div
                        class="group transition-colors duration-[400ms] text-sm flex gap-2 bg-white rounded-lg
                    items-center justify-center border shadow-lg border-slate-300 p-2 shine_animation
                    hover:text-white dark:hover:bg-defaultColor hover:bg-defaultColor dark:bg-slate-600 dark:text-white  lg:px-4">
                        <svg-component name="person" class="size-5"></svg-component>
                        <div class="text-nowrap hidden lg:block">
                            {{ useAuthStore().user === null ? 'ورود/ثبت نام' : 'داشبورد' }}
                        </div>
                    </div>
                </Link>
            </div>
            <div class="gap-2 items-center hidden md:flex">
                <!--            like-->
                <div @click="modalSet('Favorite')"
                     class="modal size-10 hover:bg-[#FF8A665E] transition-colors duration-[400ms] shine_animation bg-[#f6dfda] flex justify-center items-center rounded-xl dark:bg-opacity-50">
                    <div class="fill-none text-[#f54f19]">
                        <svg-component name="like" class="size-6"></svg-component>
                    </div>
                </div>
                <!--            dark and light mode-->
                <DarkLight></DarkLight>
            </div>
            <div class="flex justify-center gap-4 w-full md:hidden">
                <!--            mobile search box-->
                <div class=" z-10 w-60 sm:w-72">
                    <div class="relative">
                        <input type="text"
                               class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor w-full h-10 rounded-2xl bg-gray-50 border-gray-200 dark:bg-gray-600 dark:focus:border-defaultColor5 dark:text-gray-100
                                 text-xs lg:text-sm" placeholder="جستجوی محصول">
                        <div class="absolute top-2.5 left-2 cursor-pointer text-slate-200">
                            <svg-component name="search" class="size-5"></svg-component>
                        </div>
                    </div>
                </div>
                <!--                mobile login register-->
                <Link href="/login">
                    <div
                        class="size-10 flex items-center justify-center hover:bg-blue-400 transition-all rounded-xl bg-blue-300 border-slate-800 shine_animation cursor-pointer dark:bg-opacity-50"
                        title="ورود/ثبت نام">
                        <svg-component name="person" class="size-6" title="ورود/ثبت نام"></svg-component>
                    </div>
                </Link>
            </div>
        </div>
        <div class="w-full hidden md:block lg:hidden">
            <div class="relative w-fit mx-auto">
                <input type="text"
                       class="focus:outline-none focus:ring-transparent transition-colors duration-300
                        focus:border-defaultColor w-[20rem] h-10 rounded-2xl
                         bg-gray-50 border-gray-200 dark:bg-gray-600 dark:focus:border-defaultColor5 dark:text-gray-100
                                 text-xs lg:text-sm" placeholder="جستجوی محصول">
                <div class="absolute top-2.5 left-2 cursor-pointer text-slate-200">
                    <svg-component name="search" class="size-5"></svg-component>
                </div>
            </div>
        </div>
    </header>
</template>
