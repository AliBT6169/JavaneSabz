<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import AdminOrderItem from "@/Pages/Admin/Components/AdminOrderItem.vue";
import DashboardItemsLyout from "@/Pages/Admin/Components/Dashboard/DashboardItemsLyout.vue";

const props = defineProps({
    dashboardData: Object,
});
const waitOrders = ref(props.dashboardData.waitOrders.data);
console.log(waitOrders);
</script>

<template>
    <Layout>
        <!--        waitsOrder shower-->
        <DashboardItemsLyout title="سفارشات در انتظار تایید:">
            <AdminOrderItem v-for="item in waitOrders" :order="item"/>
        </DashboardItemsLyout>
        <DashboardItemsLyout>

        </DashboardItemsLyout>
    </Layout>
</template>
