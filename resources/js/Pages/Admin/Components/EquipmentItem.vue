<script setup lang="ts">

import {ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps<{
    equipment: {
        id: number,
        name: string,
        slug: string,
        iconPath: string,
        description: string,
    }
}>();
const emits = defineEmits<{
    (e: 'delete', id: number): void;
}>();
const imagePath = ref<string>(props.equipment.iconPath ? props.equipment.iconPath : '/images/default/logo.png');
</script>

<template>
    <div
        class="w-full relative overflow-hidden text-xs md:text-sm border border-adminColor1 dark:border-adminColor4 rounded-md">
        <div class="flex gap-5 items-center">
            <img :src="imagePath" alt="" class="size-20 rounded-md">
            <div class="flex gap-2 items-center justify-between px-2">
                <p class="">نام:</p>
                <p class="">{{ equipment.name }}</p>
            </div>
        </div>
        <div class="">
            <div class="space-y-2 px-2">
                <p class="line-clamp-3">{{ equipment.description }}</p>
            </div>
        </div>
        <div class="flex gap-0.5 absolute top-1 left-1">
            <Link :href="route('admin.equipments.edit',{id:equipment.id})" class="p-0.5 rounded-md bg-blue-500/50">
                <SvgComponent class="size-5" name="edit"/>
            </Link>
            <div @click="emits('delete',equipment.id)" class="p-0.5 rounded-md bg-red-500/50">
                <SvgComponent class="size-5" name="delete"/>
            </div>

        </div>
    </div>
</template>
