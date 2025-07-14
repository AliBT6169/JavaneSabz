<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";

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
            <div v-for="item in orders"
                 class="p-2 rounded-xl border-2 border-gray-500 space-y-2 w-60 bg-adminColor1 *:flex *:justify-between *:items-center *:border-b *:border-gray-500 *:pb-1 dark:bg-adminColor4">
                <div class="!justify-center">
                    <div class="">{{item.created_at}}</div>
                </div>
                <div class="">
                    <div class="">کاربر: </div>
                    <div class="">{{item.user.name}}</div>
                </div>
                <div class="">
                    <div class=""></div>
                    <div class=""></div>
                </div>
                <div class="">
                    <div class=""></div>
                    <div class=""></div>
                </div>
                <div class="">
                    <div class=""></div>
                    <div class=""></div>
                </div>
                <div class="">
                    <div class=""></div>
                    <div class=""></div>
                </div>
            </div>
        </div>
    </Layout>
</template>
