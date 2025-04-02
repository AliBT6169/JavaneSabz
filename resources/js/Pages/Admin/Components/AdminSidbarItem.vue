<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";

const props = defineProps({
    icon: '',
    href: null,
    name: 'dashboard',
    methode: null,
})
</script>

<template>
    <div
        class="h-14 duration-300 hover:text-adminColor2 hover:bg-white/20"
        :class="{'bg-white/20':useAdminStore().Page===name}">
        <Link :href="href??'#'" :method="methode??'get'" class="flex justify-center items-center gap-4 size-full"
                :class="{'pl-4 pr-2 !justify-start':useAdminStore().SideBar}">
            <svg-component :name="icon" class="size-7"/>
            <strong v-if="useAdminStore().SideBar" class="">
                <slot/>
            </strong>
        </Link>
    </div>
</template>
