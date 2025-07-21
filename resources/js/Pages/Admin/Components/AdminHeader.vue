<script setup>

import DarkLight from "@/Pages/Components/Home/DarkLight.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import AdminSearch from "@/Pages/Admin/Components/AdminSearch.vue";
</script>

<template>
    <div class="fixed top-0 right-0 px-1 z-30 sm:px-5 bg-adminColor1 w-screen h-16 border-b border-b-gray-700/50 flex items-center justify-between
                after:shadow-inner after:shadow-gray-500/40 after:absolute after:top-16 after:w-screen after:-mr-5 after:h-2 dark:bg-adminColor3/60">
        <!--        rightSide-->
        <div
            class="flex gap-2 sm:gap-5 items-center *:select-none *:cursor-pointer text-adminColor3 dark:text-adminColor2">
            <div @click="useAdminStore().SideBar = !useAdminStore().SideBar">
                <svg-component name="admin-menu" class="size-7 sm:size-10"/>
            </div>
            <svg-component name="mail" class="size-7 sm:size-10"/>
            <svg-component name="bell" class="size-7 sm:size-10"/>
        </div>
        <!--        middleSide-->
        <div class="">
        </div>
        <!--        leftSide-->
        <div class="flex items-center gap-2">
            <!--            darkMode lightMode-->
            <DarkLight/>
            <!--            profile picture-->
            <div class="relative group">
                <div class="rounded-full flex justify-center items-center bg-defaultColor size-12 overflow-hidden">
                    <img :src="useAuthStore().user.image" class="scale-105" alt="">
                </div>
                <div class="invisible z-10 opacity-0 absolute duration-300 pt-4 top-28 left-0
                group-hover:visible group-hover:opacity-100 group-hover:top-10">
                    <div class="rounded-lg w-48 border-2 bg-adminColor1 p-4 grid gap-4 dark:bg-adminColor3">
                        <!--                        items-->
                        <Link href="/" class="">
                            <div class="flex justify-between py-2 cursor-pointer duration-500 items-center
                            border-b hover:text-slate-600 dark:hover:text-gray-300 hover:px-1">
                                <svg-component name="home" class="size-7"></svg-component>
                                <div class="">صفحه اصلی</div>
                            </div>
                        </Link>
                        <Link :href="route('logout')" method="post" class="">
                            <div @click="useAuthStore().logout()" class="flex justify-between py-2 cursor-pointer duration-500 items-center
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
