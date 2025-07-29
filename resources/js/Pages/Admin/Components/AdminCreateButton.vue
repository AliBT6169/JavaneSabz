<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    tableName: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="route('admin.'+tableName+'.create')" class="m-auto size-40 flex justify-center items-center duration-300 hover:scale-95">
        <svg-component name="plus" class="size-full text-adminColor2"/>
    </Link>
</template>
