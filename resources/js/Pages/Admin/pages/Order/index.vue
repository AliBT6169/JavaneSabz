<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminOrderItemsModal from "@/Pages/Admin/Components/AdminOrderItemsModal.vue";
import AdminOrderItem from "@/Pages/Admin/Components/AdminOrderItem.vue";
import {Link} from "@inertiajs/vue3";

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
            <AdminOrderItem v-for="item in orders" :order="item"/>
            <Link :href="route('admin.orders.create')">
                <div
                    class="size-40 rounded-xl border-2 border-adminColor2 cursor-pointer duration-300 hover:scale-95 dark:border-adminColor4 flex items-center justify-center">
                    <div class="text-8xl">+</div>
                </div>
            </Link>
        </div>
    </Layout>
</template>
