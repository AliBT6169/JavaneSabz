<script setup>

import PanelSideBar from "@/Pages/Profile/Parts/PanelSideBar.vue";
import PanelHeader from "@/Pages/Profile/Parts/PanelHeader.vue";
import {profileComponent, profileSidebar, profileSidebarCloser} from "@/Pages/Components/Helper/Helper.js";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {onMounted} from "vue";

const props = defineProps(["User"]);
const authStore = useAuthStore();
authStore.setUser(props.User.data);
console.log(authStore.Orders);
</script>

<template>
    <PanelHeader></PanelHeader>
    <div class="mt-24 px-5 sm:pr-28" @click="profileSidebarCloser">
        <PanelSideBar></PanelSideBar>
        <!--        index pages-->
        <div class="w-full duration-300 bg-defaultColor5 dark:bg-defaultColor p-5 rounded-2xl"
             :class="{'lg:mr-60 lg:w-[calc(100%-15rem)]':profileSidebar}">
            <component :is="profileComponent"></component>
        </div>
    </div>
</template>
