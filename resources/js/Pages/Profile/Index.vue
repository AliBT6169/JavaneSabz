<script setup>

import Navigation from "@/Pages/Components/navigation.vue";
import PanelSideBar from "@/Pages/Profile/Parts/PanelSideBar.vue";
import PanelHeader from "@/Pages/Profile/Parts/PanelHeader.vue";
</script>

<template class="">
    <PanelHeader></PanelHeader>
    <div class="mb-20"></div>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Navigation></Navigation>
        <PanelSideBar></PanelSideBar>

    </div>
</template>
