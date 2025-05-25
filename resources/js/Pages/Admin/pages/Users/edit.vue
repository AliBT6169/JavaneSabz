<script setup>
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";

const props = defineProps({
    user: null,
});
console.log(props.user.data)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>

    </Layout>
</template>
