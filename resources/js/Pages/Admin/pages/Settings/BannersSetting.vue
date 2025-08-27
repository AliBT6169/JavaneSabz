<script setup>

import {ref} from "vue";

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
                بنر {{index + 1}}
                <div
                    class="size-[30%] cursor-pointer md:size-60 rounded-xl overflow-hidden border-4 border-transparent duration-300 relative flex justify-center">
                    <img :src="item.icon" alt="" class="size-full">
                    <div
                        class="w-1/2 absolute bottom-10 p-1 rounded-xl  text-center bg-gray-50/50  dark:bg-gray-900/50 text-sm">
                        {{ item.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
