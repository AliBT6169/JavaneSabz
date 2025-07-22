<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import AdminTransactionItem from "@/Pages/Admin/Components/Transaction/AdminTransactionItem.vue";

const props = defineProps({
    transaction_data: {
        type: Object,
        required: true
    }
});
const transactions = ref(props.transaction_data.data);
console.log(props.transaction_data);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminTransactionItem v-for="item in transactions" :transaction="item"/>
    </Layout>
</template>
