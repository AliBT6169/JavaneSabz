<script setup>

import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import PanelInput from "@/Pages/Components/Panel/panel-input.vue";
</script>

<template>
    <div class="Sidebar p-4">
        <form action="" class="">
            <div class="*:mb-5">
                <img src="../../../../../public/images/about-us/owner.jpg"
                     class="ring-2 mx-auto rounded-full w-32 ring-offset-8 ring-offset-defaultColor5
                     ring-defaultColor dark:ring-defaultColor5 dark:ring-offset-defaultColor"
                     alt="profile-picture">
                <div class="grid gap-8 place-content-center text-gray-700 dark:text-gray-300 lg:grid-cols-2 lg:text-lg">
                    <panel-input label="نام کاربری :" value="mojtaba_123" placeholder-text="نام کاربری خود را وارد کنید:" />
                    <panel-input label="نام و نام خانوادگی :" value="مجتبی قربانی" placeholder-text="نام و نام خانوادگی خود را وارد کنید:" />
                    <div class="border rounded-tr-2xl rounded-bl-2xl flex items-center gap-4 border-gray-700 dark:border-gray-300">
                        <span class="pl-2 text-black ">جنسیت :</span>
                        <label for="woman">خانم</label>
                        <input type="radio" id="woman" name="sex" class="text-defaultColor7 focus:ring-0 focus:ring-offset-0">
                        <label for="man">آقا</label>
                        <input type="radio" id="man" name="sex" class="text-defaultColor7 focus:ring-0 focus:ring-offset-0">
                    </div>
                    <panel-input label="آدرس :" value="ایران - مازندران - بهنمیر - بلوار درزیان - کیلومتر 4 - روستای گالشکلا" placeholder-text="آدرس خود را وارد کنید:" />
                    <panel-input label="کد پستی :" value="1234567890" placeholder-text="کد پستی خود را وارد کنید:" />

                </div>
            </div>
        </form>
    </div>
</template>
