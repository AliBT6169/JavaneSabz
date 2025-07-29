<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminUserMailItem from "@/Pages/Admin/pages/UserMails/AdminUserMailItem.vue";
import AdminTransactionItem from "@/Pages/Admin/Components/Transaction/AdminTransactionItem.vue";

const props = defineProps({
    mails: {
        type: Array,
        required: true
    },
})
</script>

<template>
    <Layout>
        <div class="flex flex-wrap justify-center items-center gap-5">
            <AdminUserMailItem v-if="mails.data.length>0" v-for="item in mails.data" :mail="item"/>
            <div v-else class="text-center text-xl font-bold">هیچ پیامی از سوی کاربران موجود نیست!</div>
        </div>
    </Layout>
</template>
