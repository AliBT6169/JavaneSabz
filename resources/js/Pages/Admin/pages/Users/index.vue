<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
const props = defineProps(["users"]);
</script>

<template>

    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="">users index</div>
    </Layout>
</template>
