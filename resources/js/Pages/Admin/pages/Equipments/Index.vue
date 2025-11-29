<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";

const props = defineProps<{
    equipments?: {
        id: number,
        name: string,
        slug: string,
        iconPath: string,
        description: string,
    };
    pagination?: {
        firstPageLink: string;
        lastPageLink: string;
        nextPageLink: string;
        previousPageLink: string;
        totalCount: number;
        perPage: number;
        currentPage: number;
    };
}>();
console.log(props.equipments);
</script>

<template>
    <Layout>
        <AdminPageShower pageName="مشخصات" :PageCount="props?.pagination?.totalCount"/>

        <AdminCreateButton tableName="equipments"/>
    </Layout>
</template>
