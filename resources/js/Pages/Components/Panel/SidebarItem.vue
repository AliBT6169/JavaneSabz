<script setup>
import {profileSidebar} from "@/Pages/Components/Helper/Helper.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps(["svg" , "chosen"]);

</script>

<template>
    <div class="Sidebar flex justify-between items-center px-2 cursor-pointer text-sm font-bold duration-300 h-fit
     py-4 rounded-l-2xl focus:bg-defaultColor hover:bg-defaultColor dark:focus:bg-defaultColor5 dark:hover:bg-defaultColor5 sm:px-10"
         :class="{'!justify-center !px-0 rounded-2xl': !profileSidebar , '!bg-defaultColor dark:!bg-defaultColor5':chosen}">
        <slot v-if="profileSidebar"/>
        <svg-component :name="svg" class="size-6 sm:size-8 "></svg-component>
    </div>
</template>
