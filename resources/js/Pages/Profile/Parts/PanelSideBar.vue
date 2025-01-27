<script setup>

import {profileComponent, profileSidebar} from "@/Pages/Components/Helper/Helper.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import SidebarItem from "@/Pages/Components/Panel/SidebarItem.vue";
import ShowProfile from "@/Pages/Profile/Pages/ShowProfile.vue";
import BuyCart from "@/Pages/Profile/Pages/BuyCart.vue";
import {markRaw} from "vue";

const showProfile = markRaw(ShowProfile);

const buyCart = markRaw(BuyCart);
</script>

<template class="select-none">
    <div class="invisible overflow-scroll shadow no-scroll opacity-0 grid fixed duration-300 top-20 w-20 h-[calc(100vh-5.4rem)] rounded-[40px] bg-defaultColor5
    shadow-slate-600 dark:shadow-slate-500 dark:bg-defaultColor right-2 py-10 sm:visible sm:opacity-100 sm:gap-6"
         :class="{'w-52 sm:w-80 !opacity-100 !visible':profileSidebar}">
        <SidebarItem @click="profileComponent=showProfile" svg="eye" :chosen="profileComponent===showProfile">مشاهده
            پروفایل
        </SidebarItem>
        <SidebarItem @click="profileComponent=buyCart" :chosen="profileComponent===buyCart" svg="cart">سبد خرید
        </SidebarItem>
        <SidebarItem svg="card">تراکنش ها</SidebarItem>
        <SidebarItem svg="list">پیگیری خرید</SidebarItem>
        <SidebarItem svg="like" class="fill-transparent">علاقه مندی ها</SidebarItem>
        <SidebarItem svg="comment">نظرات</SidebarItem>
        <SidebarItem svg="edit">تکمیل اطلاعات</SidebarItem>
    </div>
</template>
