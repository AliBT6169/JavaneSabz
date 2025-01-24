<script setup>

import PanelSideBar from "@/Pages/Profile/Parts/PanelSideBar.vue";
import PanelHeader from "@/Pages/Profile/Parts/PanelHeader.vue";
import {profileSidebar} from "@/Pages/Components/Helper/Helper.js";
</script>

<template>
    <PanelHeader></PanelHeader>
    <div class="mb-20"></div>
    <div class="mx-auto flex gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <PanelSideBar></PanelSideBar>
<!--        index pages-->
        <div class="w-full h-96 bg-defaultColor5 m-auto dark:bg-defaultColor lg:mr-20"></div>
    </div>
</template>
