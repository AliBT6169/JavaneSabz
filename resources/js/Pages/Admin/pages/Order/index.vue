<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminOrderItem from "@/Pages/Admin/Components/AdminOrderItem.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import {ref} from "vue";

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
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminPageShower PageName="سفارشات" :PageCount="pageCount"/>
        <Pagination :links="orderData.links" :meta="orderData.meta" :create-link="'admin.orders.create'"/>
        <div class="flex justify-center items-center gap-6 flex-wrap">
            <AdminOrderItem v-for="item in orders" :order="item"/>
            <Link :href="route('admin.orders.create')">
                <div
                    class="size-40 rounded-xl border-2 border-adminColor2 cursor-pointer duration-300 hover:scale-95 flex items-center justify-center dark:border-adminColor2">
                    <div class="text-8xl">+</div>
                </div>
            </Link>
        </div>
    </Layout>
</template>
