<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminUserTable from "@/Pages/Admin/pages/Users/AdminUserTable.vue";
import AdminUserTableItems from "@/Pages/Admin/pages/Users/AdminUserTableItems.vue";
import axios from "axios";
import {ref} from "vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

const props = defineProps(["userData"]);

const searchKeyWordChanged = (e) => {
    axios.get(route("admin.users.search", {name: e === '' ? '~' : e})).then((res) => {
        props.userData.data = res.data;
    }).catch((err) => {
        console.log(err);
    });
}
const pageCount = ref({
    currentPage: props.userData.meta.current_page,
    from: props.userData.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="کاربران" :PageCount="pageCount"/>
        <AdminInput v-if="userData.data.length>0" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <AdminUserTable>
            <AdminUserTableItems v-for="user in userData.data" :user="user"/>
        </AdminUserTable>
        <Pagination :links="userData.links" :meta="userData.meta" create-link="admin.users.create"/>
    </Layout>
</template>
