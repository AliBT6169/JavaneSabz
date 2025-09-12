<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import {ref} from "vue";

const props = {
    notifications: []
}
// const pageCount = ref({
//     currentPage: props.notifications.meta.current_page,
//     from: props.notifications.meta.last_page,
// });

console.log(props.notifications);
</script>

<template>
    <Layout>
<!--        <AdminPageShower PageName="اعلانات" :PageCount="pageCount"/>-->
        notifications
    </Layout>
</template>

<style scoped>

</style>
