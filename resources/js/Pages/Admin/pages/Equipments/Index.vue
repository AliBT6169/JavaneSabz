<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import EquipmentItem from "@/Pages/Admin/Components/EquipmentItem.vue";
import AdminPagination from "@/Pages/Admin/Components/AdminPagination.vue";
import AdminIndexSearch from "@/Pages/Admin/Components/AdminIndexSearch.vue";
import {ref} from "vue";
import axios from "axios";
import {router} from "@inertiajs/vue3";

const props = defineProps<{
    equipments?: [EquipmentInterface];
    pagination?: paginationInterface;
}>();

export interface EquipmentInterface {
    id: number,
    name: string,
    slug: string,
    iconPath: string,
    description: string,
}

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

const equipmentsHolder = ref<EquipmentInterface[]>(props.equipments);
const paginationHolder = ref<paginationInterface>(props.pagination);
const search = (word: string) => {
    if (word !== '')
        router.get(route('admin.equipments.search', {word: word}));
    else {
        router.get(route('admin.equipments.index'));
    }

}
const deleteEquipment = (id: number) => {
    axios.delete(route('admin.equipments.destroy', {id: id})).then(res => {
        equipmentsHolder.value = equipmentsHolder.value.filter(equipment => equipment.id !== id);
    }).catch(err => {
        console.log(err);
    });
}
</script>

<template>
    <Layout>
        <div class="text-center text-lg font-bold">صفحه مشخصات:</div>
        <AdminIndexSearch @update:modelValue="search($event)"/>
        <div v-if="equipments" class="space-y-5">
            <EquipmentItem @delete="deleteEquipment($event)" v-for="(item, index) in equipmentsHolder" :equipment="item"
                           :key="'equipmentItem_' + index"/>
        </div>
        <div v-else class="text-center text-lg font-bold"> هنوز جزئیاتی نساخته اید!!!</div>
        <AdminPagination v-if="equipments" :pagination="paginationHolder"/>
        <AdminCreateButton tableName="equipments"/>
    </Layout>
</template>
