<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import {useWindowSize} from "@vueuse/core";
import Layout from "@/Pages/Admin/Components/Layout.vue";
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        dashboard
    </Layout>
</template>
