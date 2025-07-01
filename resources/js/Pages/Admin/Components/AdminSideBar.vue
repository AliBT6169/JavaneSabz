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
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('AdminDashboard',1)"
                             :href="route('admin.AdminDashboard')" icon="home2" name="AdminDashboard">
                داشبورد
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('users.index',2)"
                             :href="route('admin.users.index')" icon="users" name="users.index">کاربران
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('AdminDashboard',3)" icon="roles"
                             name="AdminDashboard">مقام ها
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('products.index',4)"
                             :href="route('admin.products.index')" icon="products" name="products.index">
                محصولات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('brands.index',5)"
                             :href="route('admin.brands.index')" icon="brands" name="brands.index">برند
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('categories.index',6)" icon="categories"
                             :href="route('admin.categories.index')"
                             name="categories.index">دسته بندی
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('attributes.index',7)" icon="attributes"
                             :href="route('admin.attributes.index')"
                             name="attributes.index">خصوصیات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('AdminDashboard',8)" icon="card"
                             name="AdminDashboard">تراکنش
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('AdminDashboard',9)" icon="orders"
                             name="AdminDashboard">
                سفارشات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('AdminDashboard',10)" icon="settings"
                             name="AdminDashboard">
                تنظیمات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAuthStore().logout()" :href="route('logout')" icon="logout" methode="post">
                خروج
            </AdminSidbarItem>
        </div>
    </div>
</template>
