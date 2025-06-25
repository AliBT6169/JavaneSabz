<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";

const props = defineProps({
    brands: null,
});
console.log(props.brands)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>

    </Layout>
</template>
