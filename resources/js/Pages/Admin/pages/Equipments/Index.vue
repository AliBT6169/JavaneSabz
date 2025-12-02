<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import EquipmentItem from "@/Pages/Admin/Components/EquipmentItem.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminPagination from "@/Pages/Admin/Components/AdminPagination.vue";

const props = defineProps<{
    equipments?: [{
        id: number,
        name: string,
        slug: string,
        iconPath: string,
        description: string,
    }];
    pagination?: paginationInterface;
}>();

export interface paginationInterface {
    firstPageLink: string;
    lastPageLink: string;
    nextPageLink: string;
    previousPageLink: string;
    totalCount: number;
    perPage: number;
    currentPage: number;
    totalPage: number;
}
console.log(props.equipments);
</script>

<template>
    <Layout>
        <div class="text-center text-lg font-bold">صفحه مشخصات: </div>
        <div v-if="equipments" class="space-y-5">
            <EquipmentItem v-for="(item, index) in equipments" :equipment="item" :key="'equipmentItem_' + index"/>
        </div>
        <div v-else class="text-center text-lg font-bold"> هنوز جزئیاتی نساخته اید!!!</div>
        <AdminPagination :pagination="pagination"/>
        <AdminCreateButton tableName="equipments"/>
    </Layout>
</template>
