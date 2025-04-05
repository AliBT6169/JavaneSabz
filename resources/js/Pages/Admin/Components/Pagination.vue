<script setup>

import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: null,
    meta: null,
})
</script>

<template>

    <div class="flex items-center justify-center gap-5 py-5 *:px-4 text-sm sm:text-base
                *:rounded-xl *:border *:border-gray-700/50 *:bg-adminColor1 *:dark:bg-adminColor3 md:*:px-10 *:py-4">
        <Link :href="links.first">اولین</Link>
        <Link :class="{'!bg-opacity-50':links.prev===null}" :href="links.prev">قبلی</Link>
        <Link :class="{'!bg-opacity-50':links.next===null}" :href="links.next">بعدی</Link>
        <Link :href="links.last">آخرین</Link>
    </div>
</template>
