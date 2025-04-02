<script setup>

import {useAdminStore} from "@/Pages/Admin/Components/Stores/AdminStore.js";
import {useWindowSize} from "@vueuse/core";
</script>

<template>

    <div class="px-5 pt-20 lg:pr-52"
         @click="useAdminStore().SideBar = useWindowSize().width.value < 700 ?false:useAdminStore().SideBar">
        <slot/>
    </div>
</template>

<style scoped>

</style>
