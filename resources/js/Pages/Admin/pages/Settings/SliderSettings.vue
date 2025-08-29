<script setup>

import {ref} from "vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const sliders = ref(props.settings);
</script>

<template>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}"
         class="adminSettingPagesDesign">
        <div class="flex gap-5 items-center justify-center flex-wrap">

        </div>
    </div>
</template>
