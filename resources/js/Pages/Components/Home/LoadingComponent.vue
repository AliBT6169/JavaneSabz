<script setup lang="ts">

import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    loading: {
        type: Boolean,
        required: true,
    },
})
</script>

<template>
    <div class="fixed hidden items-center justify-center w-screen h-screen left-0 top-0 z-50 bg-gray-900/20"
         :class="{'!flex':loading}">
        <SvgComponent name="spinner" class="size-20"/>
    </div>
</template>
