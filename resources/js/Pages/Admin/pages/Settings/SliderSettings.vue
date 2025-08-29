<script setup>

import {ref} from "vue";
import SliderSettingItems from "@/Pages/Admin/pages/Settings/SliderSettingItems.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";

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
            <SliderSettingItems @created="sliders[sliders.length-1]=$event" v-for="(item, index) in sliders" :slider="item" :item-id="item.id"
                                :model-name="'اسلایدر'+(index+1)" :key="'sliderSettingItem'+index"/>
            <div @click="sliders.push({})"
                class="size-40 rounded-xl cursor-pointer border-4 duration-300 border-adminColor2
            dark:border-adminColor4 flex justify-center items-center hover:scale-90">
                <SvgComponent name="plus" class="size-30 text-adminColor2 dark:text-adminColor4"/>
            </div>
        </div>
    </div>
</template>
