<script setup>
import {profileSidebar} from "@/Pages/Components/Helper/Helper.js";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import * as $slots from "postcss";

const props = defineProps(["svg", "chosen"]);
</script>

<template>
    <div class="Sidebar relative group flex justify-between items-center px-2 cursor-pointer text-sm font-bold duration-300 h-fit
     py-4 rounded-l-2xl focus:bg-defaultColor hover:bg-defaultColor dark:focus:bg-defaultColor5 dark:hover:bg-defaultColor5 sm:px-10"
         :class="{'!justify-center !px-0 rounded-2xl': !profileSidebar , '!bg-defaultColor dark:!bg-defaultColor5':chosen}">
        <slot v-if="profileSidebar"/>
<!--        <div class="w-full absolute duration-300 invisible top-10 opacity-0 group-hover:visible group-hover:opacity-100 group-hover:top-0">-->
<!--            <div-->
<!--                class="w-fit p-1 text-sm !m-auto rounded-xl border-defaultColor border bg-defaultColor/50">-->
<!--                <slot/>-->
<!--            </div>-->
<!--        </div>-->
        <svg-component :name="svg" class="size-6 sm:size-8 "></svg-component>
    </div>
</template>
