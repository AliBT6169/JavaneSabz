<script setup>

import {useAdminStore} from "@/Pages/Components/Helper/AdminStore.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminSidbarItem from "@/Pages/Admin/Components/AdminSidbarItem.vue";
</script>

<template>
    <div class="fixed w-0 duration-300 overflow-hidden right-0 top-16 bg-adminColor2 h-[calc(100vh-4rem)] border-l border-l-gray-500/50
                dark:bg-adminColor4"
                :class="{'!w-40 md:!w-48':useAdminStore().SideBar}">
        <div class="space-y-6">
            <AdminSidbarItem @mousedown="useAdminStore().Page='mm'" icon="home2" name="mm">داشبورد</AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().Page='mh'" icon="home2" name="mh">داشبورد</AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().Page='m'" icon="home2" name="m">داشبورد</AdminSidbarItem>
            <AdminSidbarItem @mousedown="useAdminStore().Page='r'" icon="home2" name="r">داشبورد</AdminSidbarItem>
        </div>
    </div>
</template>
