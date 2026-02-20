<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";

const loading = ref<boolean>(false);
</script>

<template>
    <Layout>
        <LoadingComponent :loading="loading"/>
        <div class=""></div>

        <AdminCreateButton table-name="courses"/>
    </Layout>
</template>
