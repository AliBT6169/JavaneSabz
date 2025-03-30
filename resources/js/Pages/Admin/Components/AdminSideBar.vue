<script setup>

import {useAdminStore} from "@/Pages/Components/Helper/AdminStore.js";
</script>

<template>
    <div class="fixed w-0 duration-300 overflow-hidden right-0 top-16 bg-adminColor2 h-[calc(100vh-4rem)] border-l border-l-gray-500/50
                dark:bg-adminColor4"
                :class="{'!w-40':useAdminStore().SideBar}">
        <div class="space-y-6 *:mt-4 *:pr-2 *:py-2">
            <div class="flex bg-white/20 justify-between relative before:absolute before:h-full before:w-2 before:rounded-r-xl before:top-0 before:left-0 before:bg-adminColor3">
                sideBarItem
            </div>
        </div>
    </div>
</template>
