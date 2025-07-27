<script setup>

import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    links: null,
    meta: null,
    createLink: '#',
})
</script>

<template>

    <div class="flex items-center justify-start gap-5 *:p-2 text-sm sm:text-base sm:justify-center
                *:rounded-xl *:border *:border-gray-700/50 *:bg-adminColor1 *:dark:bg-adminColor3 md:*:px-10">
        <Link v-if="links.prev!==null" :href="links.first">
            <svg-component name="d-arrow-left" class="size-4 sm:size-5 rotate-180"/>
        </Link>
        <Link v-if="links.prev!==null" :href="links.prev">
            <svg-component name="arrow-left" class="size-4 sm:size-5 rotate-180"/>
        </Link>
        <Link v-if="createLink" :href="route(createLink)">
            افزودن
        </Link>
        <Link  v-if="links.next!==null" :href="links.next">
            <svg-component name="arrow-left" class="size-4 sm:size-5"/>
        </Link>
        <Link  v-if="links.next!==null" :href="links.last">
            <svg-component name="d-arrow-left" class="size-4 sm:size-5"/>
        </Link>
    </div>
</template>
