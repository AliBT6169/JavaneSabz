<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";

const props = defineProps({
    notifications: []
});
const pageCount = ref({
    currentPage: props.notifications.meta.current_page,
    from: props.notifications.meta.last_page,
});

onMounted(() => {
    const ides = ref([]);
    props.notifications.data.map(item => {
        ides.value.push(item.id);
    });
    axios.post(route("admin.notifications.seen"),ides.value).then(res => {
        useAdminStore().Notifications = res.data.unSeen;
    }).catch(err => {
    });
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="اعلانات" :PageCount="pageCount"/>
        <div class="space-y-5">
            <div v-for="(item, index) in notifications.data" :key="'notificationItem' + index"
                 class="p-5 flex gap-2 flex-wrap rounded-xl border-4 border-adminColor2 dark:border-adminColor4">
                <div class="*:mx-0.5">
                    <span>موضوع:  </span>
                    <strong>{{ item.title }}</strong>
                </div>
                <div class="">
                    <span class="">توضیحات:</span>
                    <p class="">{{ item.body }}</p>
                </div>
            </div>
        </div>
    </Layout>
</template>
