<script setup>

import DarkLight from "@/Pages/Components/Home/DarkLight.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
</script>

<template>
    <div class="fixed top-0 right-0 px-5 w-screen h-16 border-b border-b-gray-700/50 flex items-center justify-between
                after:shadow-inner after:shadow-gray-500/40 after:absolute after:top-16 after:w-screen after:-mr-5 after:h-2">
<!--        rightSide-->
        <div class="">

        </div>
<!--        leftSide-->
        <div class="flex gap-2 items-center">
            <DarkLight/>
            <div class="size-12 rounded-full overflow-hidden cursor-pointer">
                <img :src="useAuthStore().user.image" alt="" class="scale-105">
            </div>
        </div>
    </div>
</template>
