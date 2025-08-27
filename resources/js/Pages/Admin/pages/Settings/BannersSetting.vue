<script setup>

import {ref} from "vue";
import BannerItemSetting from "@/Pages/Admin/pages/Settings/BannerItemSetting.vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const attributes = ref(props.settings);
</script>

<template>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}"
         class="adminSettingPagesDesign">
        <div class="flex gap-5 items-center justify-center flex-wrap">
            <div
                class="text-center space-y-2"
                v-for="(item, index) in attributes">
                <BannerItemSetting :itemId="item.id" :key="'banner'+index" :banner="item" :modelName="'بنر '+(index+1)"/>
            </div>
        </div>
    </div>
</template>
