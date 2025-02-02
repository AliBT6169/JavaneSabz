<script setup>

import PanelInput from "@/Pages/Components/Panel/panel-input.vue";
</script>

<template>
    <div class="Sidebar p-4">
        <form action="" class="">
            <div class="*:mb-5">
                <div class="m-auto w-60">
                    <label for="profile-picture" class="size-60 overflow-clip">
                        <input type="file" name="profile-picture" class="invisible" id="profile-picture" src="../../../../../public/images/about-us/owner.jpg">
                        <img src="../../../../../public/images/about-us/owner.jpg"
                             class="ring-2 mx-auto cursor-pointer rounded-full duration-300 w-32 ring-offset-8 ring-offset-defaultColor5
                     ring-defaultColor dark:ring-defaultColor5 dark:ring-offset-defaultColor hover:scale-95"
                             alt="profile-picture">
                    </label>
                </div>
                <div class="grid gap-8 place-content-center text-gray-700 dark:text-gray-300 lg:grid-cols-2 lg:text-lg">
                    <panel-input label="نام کاربری :" value="mojtaba_123" placeholder-text="نام کاربری خود را وارد کنید:" />
                    <panel-input label="نام و نام خانوادگی :" value="مجتبی قربانی" placeholder-text="نام و نام خانوادگی خود را وارد کنید:" />
                    <div class="space-y-2">
                        <span class="pl-4 text-black dark:text-white">جنسیت :</span>
                        <div class="border rounded-tr-2xl rounded-bl-2xl flex px-2 py-1.5 items-center gap-4 border-defaultColor dark:border-defaultColor5">
                            <label for="woman">خانم</label>
                            <input type="radio" id="woman" name="sex" class="text-defaultColor7 focus:ring-0 focus:ring-offset-0">
                            <label for="man">آقا</label>
                            <input type="radio" id="man" name="sex" class="text-defaultColor7 focus:ring-0 focus:ring-offset-0">
                        </div>
                    </div>
                    <panel-input label="شماره تماس :" value="09123456789" placeholder-text="شماره تلفن خود را وارد کنید:" />
                    <panel-input label="آدرس ایمیل :" type="email" value="mojtabaGhorbani0@gmail.com" placeholder-text="آدرس ایمیل خود را وارد کنید:" />
                    <panel-input label="آدرس :" value="ایران - مازندران - بهنمیر - بلوار درزیان - کیلومتر 4 - روستای گالشکلا" placeholder-text="آدرس خود را وارد کنید:" />
                    <panel-input label="کد پستی :" value="1234567890" placeholder-text="کد پستی خود را وارد کنید:" />
                </div>
            </div>
        </form>
    </div>
</template>
