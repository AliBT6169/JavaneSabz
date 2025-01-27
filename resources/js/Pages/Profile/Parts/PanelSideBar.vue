<script setup>

import {profileComponent, profileSidebar} from "@/Pages/Components/Helper/Helper.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import SidebarItem from "@/Pages/Components/Panel/SidebarItem.vue";
import ShowProfile from "@/Pages/Profile/Pages/ShowProfile.vue";
import BuyCart from "@/Pages/Profile/Pages/BuyCart.vue";
import {markRaw} from "vue";
import Transaction from "@/Pages/Profile/Pages/Transaction.vue";
import Payment from "@/Pages/Profile/Pages/Payment.vue";
import Favorite from "@/Pages/Profile/Pages/Favorite.vue";
import Comments from "@/Pages/Profile/Pages/Comments.vue";
import InformationEdit from "@/Pages/Profile/Pages/InformationEdit.vue";

const showProfile = markRaw(ShowProfile);
const buyCart = markRaw(BuyCart);
const transaction = markRaw(Transaction);
const payment = markRaw(Payment);
const favorite = markRaw(Favorite);
const comment = markRaw(Comments);
const information_edit = markRaw(InformationEdit);


</script>

<template class="select-none">
    <div class="invisible overflow-scroll shadow no-scroll opacity-0 grid fixed z-10 duration-300 top-20 w-20 h-[calc(100vh-5.4rem)] rounded-[40px] bg-defaultColor5
    shadow-slate-600 dark:shadow-slate-500 dark:bg-defaultColor right-2 py-10 sm:visible sm:opacity-100 sm:gap-6"
         :class="{'w-52 sm:w-80 !opacity-100 !visible':profileSidebar}">
        <SidebarItem @click="profileComponent=showProfile" svg="eye" :chosen="profileComponent===showProfile">مشاهده
            پروفایل
        </SidebarItem>
        <SidebarItem @click="profileComponent=buyCart" :chosen="profileComponent===buyCart" svg="cart">سبد خرید
        </SidebarItem>
        <SidebarItem @click="profileComponent=transaction" :chosen="profileComponent===Transaction" svg="card" >تراکنش ها</SidebarItem>
        <SidebarItem @click="profileComponent=payment" :chosen="profileComponent===Payment" svg="list">پیگیری خرید</SidebarItem>
        <SidebarItem @click="profileComponent=favorite" :chosen="profileComponent===Favorite" svg="like" class="fill-transparent">علاقه مندی ها</SidebarItem>
        <SidebarItem @click="profileComponent=comment" :chosen="profileComponent===Comments" svg="comment">نظرات</SidebarItem>
        <SidebarItem @click="profileComponent=information_edit" :chosen="profileComponent===InformationEdit" svg="edit">تکمیل اطلاعات</SidebarItem>
    </div>
</template>
