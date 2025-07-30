<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import AdminTransactionItem from "@/Pages/Admin/Components/Transaction/AdminTransactionItem.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

const props = defineProps({
    transaction_data: {
        type: Object,
        required: true
    }
});
const transactions = ref(props.transaction_data.data);
const pageCount = ref({
    currentPage: props.transaction_data.meta.current_page,
    from: props.transaction_data.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="تراکنش ها" :PageCount="pageCount"/>
        <AdminTransactionItem v-if="transactions.length>0" v-for="item in transactions" :transaction="item"/>
        <div v-else class="text-center text-xl font-bold">تراکنشی انجام نشده!</div>
    </Layout>
</template>
