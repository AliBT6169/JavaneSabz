<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminUserTable from "@/Pages/Admin/pages/Users/AdminUserTable.vue";
import AdminUserTableItems from "@/Pages/Admin/pages/Users/AdminUserTableItems.vue";

const props = defineProps(["userData"]);
console.log(props.userData)
</script>

<template>
    <Layout>
        <AdminInput class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <AdminUserTable>
            <AdminUserTableItems v-for="user in userData.data" :user="user"/>
        </AdminUserTable>
        <Pagination :links="userData.links" :meta="userData.meta" create-link="admin.users.create"/>
    </Layout>
</template>
