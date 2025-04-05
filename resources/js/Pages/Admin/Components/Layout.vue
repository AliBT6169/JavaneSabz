<script setup>

import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import {useWindowSize} from "@vueuse/core";
</script>

<template>

    <div class="pr-20 pl-4 duration-300 pt-20"
         :class="{' lg:pr-52':useAdminStore().SideBar}"
         @click="useAdminStore().SideBar = useWindowSize().width.value < 700 ?false:useAdminStore().SideBar">
        <slot/>
    </div>
</template>

<style scoped>

</style>
