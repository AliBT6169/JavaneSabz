<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import AdminTransactionItem from "@/Pages/Admin/Components/Transaction/AdminTransactionItem.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";

const props = defineProps({
    transaction_data: {
        type: Object,
        required: true
    }
});
const transactions = ref(props.transaction_data.data);
</script>

<template>
    <Layout>
        <AdminTransactionItem v-if="transactions.length>0" v-for="item in transactions" :transaction="item"/>
        <div v-else class="text-center text-xl font-bold">تراکنشی انجام نشده!</div>
    </Layout>
</template>
