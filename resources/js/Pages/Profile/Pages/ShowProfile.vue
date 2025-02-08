<script setup>

import {userData} from "../DashboardContainer.js";
</script>

<template>
    <div class="*:mb-5">
        <img src="../../../../../public/images/about-us/owner.jpg"
             class="ring-2 mx-auto rounded-full w-32 ring-offset-8 ring-offset-defaultColor5
                     ring-defaultColor dark:ring-defaultColor5 dark:ring-offset-defaultColor"
             alt="profile-picture">
        <div class="grid gap-8 place-content-center text-gray-700 dark:text-gray-300 lg:grid-cols-2 lg:text-lg">
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">نام کاربری :</span>
                <span>{{userData.name}}</span>
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
</template>
