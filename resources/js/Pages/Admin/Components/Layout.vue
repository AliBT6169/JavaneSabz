<script setup>

import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import {useWindowSize} from "@vueuse/core";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <div class="pr-20 pl-4 duration-300 pt-20 space-y-5"
         :class="{' lg:pr-52':useAdminStore().SideBar}"
         @click="useAdminStore().SideBar = useWindowSize().width.value < 700 ?false:useAdminStore().SideBar">
        <slot/>
    </div>
</template>

<style scoped>

</style>
