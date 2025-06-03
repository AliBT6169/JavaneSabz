<script setup>

import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminSidbarItem from "@/Pages/Admin/Components/AdminSidbarItem.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {router} from "@inertiajs/vue3";
</script>

<template>
    <div class="fixed w-16 duration-300 overflow-scroll no-scrollbar z-30 right-0 top-16 bg-adminColor2 h-[calc(100vh-4rem)] border-l border-l-gray-500/50
                dark:bg-adminColor4"
         :class="{'!w-40 md:!w-48':useAdminStore().SideBar}">
        <div class="absolute duration-300 h-14 w-2 rounded-r-xl left-0 bg-adminColor3 dark:bg-adminColor2"
             :style="{top:useAdminStore().PageIndexTop + 'px'}"></div>
        <div class="space-y-6 pt-4">
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('dashboard',1)" :href="route('admin.AdminDashboard')" icon="home2" name="dashboard">
                داشبورد
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('users',2)" :href="route('admin.users.index')" icon="users" name="users">کاربران
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('roles',3)" icon="roles" name="roles">مقام ها
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('products',4)" :href="route('admin.products.index')" icon="products" name="products">
                محصولات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('brands',5)" icon="brands" name="brands">برند
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('categories',6)" icon="categories"
                             name="categories">دسته بندی
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('attributes',7)" icon="attributes"
                             name="attributes">خصوصیات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('transactions',8)" icon="card"
                             name="transactions">تراکنش
                ها
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('orders',9)" icon="orders" name="orders">
                سفارشات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('settings',10)" icon="settings" name="settings">
                تنظیمات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAuthStore().logout()" :href="route('logout')" icon="logout" methode="post">
                خروج
            </AdminSidbarItem>
        </div>
    </div>
</template>
