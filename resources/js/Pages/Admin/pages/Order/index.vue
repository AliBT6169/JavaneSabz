<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminOrderItem from "@/Pages/Admin/Components/AdminOrderItem.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import {ref} from "vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";

const props = defineProps({
    orderData: {
        required: true,
    }
});
const orders = props.orderData.data;
const pageCount = ref({
    currentPage: props.orderData.meta.current_page,
    from: props.orderData.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="سفارشات" :PageCount="pageCount"/>
        <div v-if="orders.length>0" class="flex w-full justify-center items-center gap-6 flex-wrap">
            <AdminOrderItem v-for="item in orders" :order="item"/>
        </div>
        <div v-else class="text-center text-xl font-bold">سفارشی موجود نیست!</div>
        <AdminCreateButton table-name="orders"/>
        <Pagination :links="orderData.links" :meta="orderData.meta" :create-link="'admin.orders.create'"/>
    </Layout>
</template>
