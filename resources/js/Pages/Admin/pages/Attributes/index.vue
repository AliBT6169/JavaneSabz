<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";

const props = defineProps({
    attributes: {
        required: true,
    }
});
console.log(props.attributes);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        attributes
    </Layout>
</template>
