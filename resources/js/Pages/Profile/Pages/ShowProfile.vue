<script setup>
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";

const authUser = ref(useAuthStore());


</script>

<template>
    <div class="*:mb-5">
        <img :src="authUser.user.image"
             class="ring-2 mx-auto rounded-full size-32 ring-offset-8 ring-offset-defaultColor5
                     ring-defaultColor dark:ring-defaultColor5 dark:ring-offset-defaultColor"
             alt="profile-picture">
        <div class="grid gap-8 place-content-center text-gray-700 dark:text-gray-300 lg:grid-cols-2 lg:text-lg">
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black" @click="useAuthStore()">نام کاربری :</span>
                <span>{{ authUser.user.name }}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">نام و نام خانوادگی :</span>
                <span>{{ authUser.user.full_name ?? 'وارد نشده' }}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">شماره همراه :</span>
                <span>{{ authUser.user.cellphone ?? 'وارد نشده' }}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">ایمیل :</span>
                <span>{{ authUser.user.email ?? 'وارد نشده' }}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">جنسیت :</span>
                <span>{{ authUser.user.gender === 0 ? 'خانم' : 'آقا' }}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">آدرس :</span>
                <span>{{authUser.user.user_address.full_address??'وارد نشده'}}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">کد پستی :</span>
                <span>{{ authUser.user.user_post_code??'وارد نشده' }}</span>
            </div>
            <div class="border-b border-gray-700 dark:border-gray-300">
                <span class="pl-2 text-black">تاریخ ساخت :</span>
                <span>{{authUser.user.created_at}}</span>
            </div>
        </div>
    </div>
</template>
