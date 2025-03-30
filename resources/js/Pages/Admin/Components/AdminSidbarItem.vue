<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {useAdminStore} from "@/Pages/Components/Helper/AdminStore.js";

const props = defineProps({
    icon: '',
    href: null,
    name: 'dashboard',
})
</script>

<template>
    <Link :href="props.href??'#'">
        <div class="flex items-center gap-4 pl-4 pr-2 h-14 duration-300 hover:text-adminColor2 hover:bg-white/20"
             :class="{'relative bg-white/20':useAdminStore().Page===props.name}">
            <svg-component :name="props.icon" class="size-7"/>
            <strong class=""><slot/></strong>
        </div>
    </Link>
</template>
