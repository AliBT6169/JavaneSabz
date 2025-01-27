<script setup>

import PanelSideBar from "@/Pages/Profile/Parts/PanelSideBar.vue";
import PanelHeader from "@/Pages/Profile/Parts/PanelHeader.vue";
import {profileSidebar} from "@/Pages/Components/Helper/Helper.js";
</script>

<template>
    <PanelHeader></PanelHeader>
    <div class="mb-24"></div>
    <div class="px-5 sm:pr-28">
        <PanelSideBar></PanelSideBar>
        <!--        index pages-->
        <div class="w-full duration-300 bg-defaultColor5 dark:bg-defaultColor p-5 rounded-2xl"
             :class="{'lg:mr-60 lg:w-[calc(100%-15rem)]':profileSidebar}">
            <div class="*:mb-5">
                <img src="../../../../public/images/about-us/owner.jpg"
                     class="ring-2 mx-auto rounded-full w-32 ring-offset-8 ring-offset-defaultColor5
                     ring-defaultColor dark:ring-defaultColor5 dark:ring-offset-defaultColor"
                     alt="profile-picture">
                <div class="grid gap-8 place-content-center text-gray-700 dark:text-gray-300 lg:grid-cols-2 lg:text-lg">
                    <div class="border-b border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black">نام کاربری :</span>
                        <span>mojtaba-ghorbani</span>
                    </div>
                    <div class="border-b border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black">نام و نام خانوادگی :</span>
                        <span>مجتبی قربانی</span>
                    </div>
                    <div class="border-b border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black">جنسیت :</span>
                        <span>مرد</span>
                    </div>
                    <div class="border-b border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black">آدرس :</span>
                        <span>ایران - مازندران - بهنمیر - بلوار درزیان - کیلومتر 4 - روستای گالشکلا</span>
                    </div>
                    <div class="border-b border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black">کد پستی :</span>
                        <span>111-111-1111</span>
                    </div>
                    <div class="border-b border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black">تاریخ ساخت :</span>
                        <span>1403/01/01</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
