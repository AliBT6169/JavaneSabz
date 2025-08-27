<script setup>

import {ref} from "vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const attributes = ref(props.settings);
const toggleBrand = async (id) => {
    await axios.patch(route("admin.brands.bestBrandToggle", id)).then((response) => {
        attributes.value = response.data;
    }).catch((error) => {
        console.log(error);
    });
}
</script>

<template>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}"
         class="adminSettingPagesDesign">
        <div class="flex gap-5 items-center justify-center flex-wrap">
            <div @click="toggleBrand(item.id)"
                 class="size-[30%] md:size-60 rounded-xl overflow-hidden border-4 border-transparent duration-300 relative flex justify-center"
                 :class="{'!border-green-500':item.is_best}"
                 v-for="item in attributes">
                <img :src="item.icon" alt="" class="size-full">
                <div class="w-1/2 absolute bottom-10 p-1 rounded-xl  text-center bg-gray-50/50  dark:bg-gray-900/50">
                    {{ item.name }}
                </div>
            </div>
        </div>
    </div>
</template>
