<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";

const props = defineProps({
    commentsData: Array,
})
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>

    </Layout>
</template>
