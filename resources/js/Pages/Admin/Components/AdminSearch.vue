<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
</script>

<template>
    <div class="w-36 sm:w-48 h-8 rounded-full relative overflow-hidden border border-gray-700/40">
        <input type="text" class="size-full text-sm border-none focus:ring-0 pl-8 bg-white/80 dark:bg-gray-800/50">
        <div class="bg-adminColor2 h-full px-2 absolute left-0 top-0 flex items-center justify-center cursor-pointer">
            <svg-component name="search" class="size-4"/>
        </div>
    </div>
</template>
