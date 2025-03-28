<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import {useAdminStore} from "@/Pages/Components/Helper/AdminStore.js";
import {useWindowSize} from "@vueuse/core";
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <!--    Layout-->
    <div class="px-5 pt-20 lg:pr-52" @click="useAdminStore().SideBar = useWindowSize().width < 700 ?false:useAdminStore().SideBar">
        <div class="w-fit m-auto p-20 bg-green-500">
            content
        </div>
    </div>
</template>
