<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminOrderItems from "@/Pages/Admin/Components/AdminOrderItems.vue";

const props = defineProps({
    orderData: {
        required: true,
    }
});
const orders = props.orderData.data;
console.log(props.orderData);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="flex justify-center items-center gap-6 flex-wrap">
            <AdminOrderItems v-for="item in orders" :order="item"/>
        </div>
    </Layout>
</template>
