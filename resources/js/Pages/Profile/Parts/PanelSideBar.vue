<script setup>

import {profileSidebar} from "@/Pages/Components/Helper/Helper.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import SidebarItem from "@/Pages/Components/Panel/SidebarItem.vue";
</script>

<template>
    <div class="hidden fixed duration-300 top-20 w-20 h-[calc(100vh-5.4rem)] rounded-full bg-defaultColor5
    dark:bg-defaultColor right-2 py-10 sm:grid sm:gap-6" :class="{'w-40 rounded-[40px] sm:w-80 !grid':profileSidebar}">
        <SidebarItem svg="eye">مشاهده پروفایل</SidebarItem>
        <SidebarItem svg="cart">سبد خرید</SidebarItem>
        <SidebarItem svg="card">تراکنش ها</SidebarItem>
        <SidebarItem svg="list">پیگیری خرید</SidebarItem>
        <SidebarItem svg="like" class="fill-transparent">علاقه مندی ها</SidebarItem>
        <SidebarItem svg="comment">نظرات</SidebarItem>
        <SidebarItem svg="edit">تکمیل اطلاعات</SidebarItem>
    </div>
</template>
