<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import EquipmentItem from "@/Pages/Admin/Components/EquipmentItem.vue";
import AdminPagination from "@/Pages/Admin/Components/AdminPagination.vue";
import AdminIndexSearch from "@/Pages/Admin/Components/AdminIndexSearch.vue";
import {ref} from "vue";
import axios from "axios";
import {router} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";

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
const loading = ref<boolean>(false);
const search = (word: string) => {
    if (word !== '')
        router.get(route('admin.equipments.search', {word: word}));
    else {
        router.get(route('admin.equipments.index'));
    }
}

const deleteEquipment = (id: number) => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ویرایش این جزئیات هستید؟'
        },
        listeners: {
            set: () => {
                loading.value = true;
                axios.delete(route('admin.equipments.destroy', {id: id})).then(res => {
                    loading.value = false;
                    equipmentsHolder.value = equipmentsHolder.value.filter(equipment => equipment.id !== id);
                }).catch(err => {
                    loading.value = false;
                    console.log(err);
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);
}
</script>

<template>
    <Layout>
        <loading-component :loading="loading"/>
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
