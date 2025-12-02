<script setup lang="ts">
import { paginationInterface } from '../pages/Equipments/Index.vue';
import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";
const props = defineProps<{
    pagination: paginationInterface
}>();
</script>

<template>
    <div class="flex items-center justify-start gap-5 *:p-2 text-sm sm:text-base sm:justify-center
                *:rounded-xl *:border *:border-gray-700/50 *:bg-adminColor1 *:dark:bg-adminColor3 md:*:px-10">
        <Link v-if="pagination.firstPageLink!==null" :href="pagination.firstPageLink">
            <svg-component name="d-arrow-left" class="size-4 sm:size-5 rotate-180"/>
        </Link>
        <Link v-if="pagination.previousPageLink!==null" :href="pagination.previousPageLink">
            <svg-component name="arrow-left" class="size-4 sm:size-5 rotate-180"/>
        </Link>
        <div class="">
            <span class="">صفحه </span>
            <span class="">{{pagination.currentPage}}</span>
            <span class=""> از </span>
            <span class="">{{pagination.totalPage}}</span>
        </div>
        <Link  v-if="pagination.nextPageLink!==null" :href="pagination.nextPageLink">
            <svg-component name="arrow-left" class="size-4 sm:size-5"/>
        </Link>
        <Link  v-if="pagination.lastPageLink!==null" :href="pagination.lastPageLink">
            <svg-component name="d-arrow-left" class="size-4 sm:size-5"/>
        </Link>
    </div>
</template>
