<script setup>

import {ref} from "vue";
import BannerItemSetting from "@/Pages/Admin/pages/Settings/BannerItemSetting.vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const banners = ref(props.settings);
</script>

<template>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}"
         class="adminSettingPagesDesign">
        <div class="flex gap-5 items-center justify-center flex-wrap">
            <BannerItemSetting v-for="(item, index) in banners" :itemId="item.id" :key="'banner'+index" :banner="item"
                               :modelName="'بنر '+(index+1)"/>
        </div>
    </div>
</template>
