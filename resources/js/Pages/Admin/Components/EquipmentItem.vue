<script setup lang="ts">

import {ref} from "vue";

const props = defineProps<{
    equipment: {
        id: number,
        name: string,
        slug: string,
        iconPath: string,
        description: string,
    }
}>();
const imagePath = ref<string>(props.equipment.iconPath ? '/' + props.equipment.iconPath : '/images/default/logo.png');
</script>

<template>
    <div
        class="w-full overflow-hidden text-xs md:text-sm border border-adminColor1 dark:border-adminColor4 rounded-md">
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
    </div>
</template>
