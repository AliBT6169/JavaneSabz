<script setup>

import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminSidbarItem from "@/Pages/Admin/Components/AdminSidbarItem.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {router} from "@inertiajs/vue3";
</script>

<template>
    <div class="fixed w-16 duration-300 overflow-scroll no-scrollbar z-20 right-0 top-16 bg-adminColor2 h-[calc(100vh-4rem)] border-l border-l-gray-500/50
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
            <!--            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('AdminDashboard',3)" icon="roles"-->
            <!--                             name="AdminDashboard">مقام ها-->
            <!--            </AdminSidbarItem>-->
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('products.index',3)"
                             :href="route('admin.products.index')" icon="products" name="products.index">
                محصولات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('brands.index',4)"
                             :href="route('admin.brands.index')" icon="brands" name="brands.index">برند
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('categories.index',5)" icon="categories"
                             :href="route('admin.categories.index')"
                             name="categories.index">دسته بندی
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('attributes.index',6)" icon="attributes"
                             :href="route('admin.attributes.index')"
                             name="attributes.index">خصوصیات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('transactions.index',7)" icon="card"
                             :href="route('admin.transactions.index')"
                             name="transactions.index">تراکنش
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('orders.index',8)" icon="orders"
                             :href="route('admin.orders.index')" name="orders.index">
                سفارشات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('comments.index',9)" icon="comment"
                             :href="route('admin.comments.index')" name="comments.index">
                نظرات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().sideBarSelector('settings.index',10)" icon="settings"
                             :href="route('admin.settings.index')" name="settings.index">
                تنظیمات
            </AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAuthStore().logout()" :href="route('logout')" icon="logout" methode="post">
                خروج
            </AdminSidbarItem>
        </div>
    </div>
</template>
