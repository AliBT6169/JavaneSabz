<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import AdminOrderItem from "@/Pages/Admin/Components/AdminOrderItem.vue";
import DashboardItemsLyout from "@/Pages/Admin/Components/Dashboard/DashboardItemsLyout.vue";
import AdminProductShow from "@/Pages/Admin/Components/Dashboard/AdminProductShow.vue";
import AdminCommentItem from "@/Pages/Admin/pages/Comments/AdminCommentItem.vue";
import AdminTransactionItem from "@/Pages/Admin/Components/Transaction/AdminTransactionItem.vue";
import AdminUserTable from "@/Pages/Admin/pages/Users/AdminUserTable.vue";
import AdminUserTableItems from "@/Pages/Admin/pages/Users/AdminUserTableItems.vue";
import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const props = defineProps({
    dashboardData: Object,
});
const waitOrders = ref(props.dashboardData.waitOrders.data);
const niceSaleProducts = ref(props.dashboardData.niceSaleProducts.data);
const noQuantityProducts = ref(props.dashboardData.noQuantityProducts.data);
const newComments = ref(props.dashboardData.newComments.data);
const newTransactions = ref(props.dashboardData.newTransactions.data);
const mostBuyerUsers = ref(props.dashboardData.mostBuyerUsers.data);
useAuthStore().setUser(props.dashboardData.selfData)
useAdminStore().setNotifications(props.dashboardData.unSeenNotifications)
</script>

<template>
    <Layout>
        <!--        waitsOrder shower-->
        <DashboardItemsLyout title="سفارشات در انتظار تایید:">
            <AdminOrderItem v-if="waitOrders.length>0" v-for="item in waitOrders" :order="item"/>
            <div v-else class="text-2xl font-bold">هنوز سفارشی موجود نیست!</div>
        </DashboardItemsLyout>
        <DashboardItemsLyout title="محصولات پرفروش:">
            <AdminProductShow v-if="niceSaleProducts.length>0" v-for="item in niceSaleProducts" :product="item"/>
            <div v-else class="text-2xl font-bold">هنوز محصولی فروخته نشده است!</div>
        </DashboardItemsLyout>
        <DashboardItemsLyout title="اتمام موجودی ها:">
            <AdminProductShow v-if="noQuantityProducts.length>0" v-for="item in noQuantityProducts" :product="item"/>
            <div v-else class="text-2xl font-bold">فعلا محصول بدون موجودی موجود نیست!</div>
        </DashboardItemsLyout>
        <div class="space-y-5 p-5 rounded-xl border-4 border-adminColor2">
            <div class="text-lg font-bold">نظرات جدید:</div>
            <div class="flex flex-wrap gap-5 justify-center lg:block lg:space-y-5">
                <AdminCommentItem v-if="newComments.length>0" v-for="item in newComments" :comment="item"/>
                <div v-else class="text-2xl font-bold">نظر جدیدی موجود نیست!</div>
            </div>
        </div>
        <div class="space-y-5 p-5 rounded-xl border-4 border-adminColor2">
            <div class="text-lg font-bold">آخرین تراکنش ها:</div>
            <div class="flex flex-wrap gap-5 justify-center lg:block lg:space-y-5">
                <AdminTransactionItem v-if="newTransactions.length>0" v-for="item in newTransactions"
                                      :transaction="item"/>
                <div v-else class="text-2xl font-bold">هنوز تراکنشی انجام نشده!</div>
            </div>
        </div>
        <div class="space-y-5 p-5 rounded-xl border-4 border-adminColor2">
            <div class="text-lg font-bold">پرخرید ترین کاربران:</div>
            <div class="flex flex-wrap gap-5 justify-center lg:block lg:space-y-5">
                <AdminUserTable v-if="mostBuyerUsers.length > 0">
                    <AdminUserTableItems v-for="item in mostBuyerUsers" :user="item"/>
                </AdminUserTable>
                <div v-else class="text-2xl font-bold text-center">هنوز کاربری موجود نیست!</div>
            </div>
        </div>
    </Layout>
</template>
