<script setup>

import {useAdminStore} from "@/Pages/Components/Helper/AdminStore.js";
</script>

<template>
    <div class="fixed w-0 duration-300 overflow-hidden right-0 top-16 bg-adminColor2 h-[calc(100vh-4rem)] border-l border-l-gray-500/50
                dark:bg-adminColor4"
                :class="{'!w-40':useAdminStore().SideBar}"></div>
</template>
