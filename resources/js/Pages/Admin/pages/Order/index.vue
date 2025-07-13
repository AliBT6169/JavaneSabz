<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";

const props = defineProps({
    orderData: {
        required: true,
    }
});
console.log(props.orderData);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        Orders
    </Layout>
</template>

<style scoped>

</style>
