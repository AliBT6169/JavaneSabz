<script setup>
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
</script>

<template>
    <Layout>
        <AdminTransactionItem v-for="item in transactions" :transaction="item"/>
    </Layout>
</template>
