<script setup>

import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    links: null,
    meta: null,
})
</script>

<template>

    <div class="flex items-center justify-start gap-5 py-5 *:p-2 text-sm sm:text-base sm:justify-center
                *:rounded-xl *:border *:border-gray-700/50 *:bg-adminColor1 *:dark:bg-adminColor3 md:*:px-10">
        <Link :href="links.first">
            <svg-component name="d-arrow-left" class="size-4 sm:size-5 rotate-180"/>
        </Link>
        <Link :class="{'!bg-opacity-50':links.prev===null}" :href="links.prev">
            <svg-component name="arrow-left" class="size-4 sm:size-5 rotate-180"/>
        </Link>
        <Link :href="route('admin.users.create')">
            افزودن
        </Link>
        <Link :class="{'!bg-opacity-50':links.next===null}" :href="links.next">
            <svg-component name="arrow-left" class="size-4 sm:size-5"/>
        </Link>
        <Link :href="links.last">
            <svg-component name="d-arrow-left" class="size-4 sm:size-5"/>
        </Link>
    </div>
</template>
