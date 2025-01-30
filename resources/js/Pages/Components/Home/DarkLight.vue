<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {useDark, useToggle} from "@vueuse/core";
import {ref} from "vue";

const isDark = useDark();
const name = ref(isDark ? 'sun' : 'moon2')
const toggleDark = useToggle(isDark);
</script>

<template>
    <div
        class="size-10 flex items-center justify-center hover:bg-slate-400 transition-all rounded-xl bg-slate-300 border-slate-800 shine_animation cursor-pointer dark:bg-opacity-50"
        @click="toggleDark()">
        <svg-component :name="isDark===true ? 'sun' : 'moon2'" class="size-6" title="دارک مود"></svg-component>
    </div>
</template>
