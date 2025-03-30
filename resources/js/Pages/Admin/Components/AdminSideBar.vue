<script setup>

import {useAdminStore} from "@/Pages/Components/Helper/AdminStore.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminSidbarItem from "@/Pages/Admin/Components/AdminSidbarItem.vue";
</script>

<template>
    <div class="fixed w-0 duration-300 overflow-hidden right-0 top-16 bg-adminColor2 h-[calc(100vh-4rem)] border-l border-l-gray-500/50
                dark:bg-adminColor4"
         :class="{'!w-40 md:!w-48':useAdminStore().SideBar}">
        <div class="absolute duration-300 h-14 w-2 rounded-r-xl left-0 bg-adminColor3 dark:bg-adminColor2"
             :style="{top:useAdminStore().PageIndexTop + 'px'}"></div>
        <div class="space-y-6 pt-4">
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('dashboard',1)" icon="home2" name="dashboard">
                داشبورد
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('users',2)" icon="home2" name="users">کاربران
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('products',3)" icon="home2" name="products">
                محصولات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('brands',4)" icon="home2" name="brands">برند
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('categories',5)" icon="home2"
                             name="categories">دسته بندی
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('attributes',6)" icon="home2"
                             name="attributes">خصوصیات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('transactions',7)" icon="home2"
                             name="transactions">تراکنش
                ها
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('orders',8)" icon="home2" name="orders">سفارشات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('settings',9)" icon="home2" name="settings">
                تنظیمات
            </AdminSidbarItem>
        </div>
    </div>
</template>
