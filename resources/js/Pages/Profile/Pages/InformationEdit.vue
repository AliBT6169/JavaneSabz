<script setup>

import PanelInput from "@/Pages/Components/Panel/panel-input.vue";
import {ref} from "vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import axios from "axios";

const store = useAuthStore();
const userInfo = ref(useAuthStore().user);
const formData = new FormData();

const form = {
    id: userInfo.value.id,
    image: userInfo.value.image,
    name: userInfo.value.name,
    full_name: userInfo.value.full_name,
    gender: userInfo.value.gender,
    cellphone: userInfo.value.cellphone,
    email: userInfo.value.email,
    address: userInfo.value.user_address,
    post_code: userInfo.value.user_post_code,
};

const submitForm = async (form) => {
    await store.informationUpdate(form);
}
const imagePreview = ref(form.image);

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);

    } else {
        imagePreview.value = null;
    }
}
</script>

<template>
    <div class="Sidebar p-4">
        <form action="" @submit.prevent=" submitForm(form)" class="">
            <div class="*:mb-5">
                <div class="m-auto sm:w-60">
                    <label for="profile-picture" class="size-60 overflow-clip">
                        <input type="file" name="profile_picture" class="invisible" id="profile-picture"
                               @input="(e)=>form.image = e.target.files[0]" @change="onFileChange" accept="*image/*">
                        <img :src="imagePreview"
                             class="ring-2 mx-auto cursor-pointer rounded-full duration-300 size-32 ring-offset-8 ring-offset-defaultColor5
                     ring-defaultColor dark:ring-defaultColor5 dark:ring-offset-defaultColor hover:scale-95"
                             alt="profile-picture">
                    </label>
                </div>
                <div class="grid gap-8 place-content-center text-gray-700 dark:text-gray-300 lg:grid-cols-2 lg:text-lg">
                    <panel-input label="نام کاربری :" :value="form.name"
                                 @updateValue="(item)=>form.name=item"
                                 placeholder-text="نام کاربری خود را وارد کنید:"/>
                    <panel-input label="نام و نام خانوادگی :" :value="form.full_name"
                                 @updateValue="(item)=>form.full_name=item"
                                 placeholder-text="نام و نام خانوادگی خود را وارد کنید:"/>
                    <div class="space-y-2">
                        <span class="pl-4 text-black dark:text-white">جنسیت :</span>
                        <div
                            class="border *:cursor-pointer rounded-tr-2xl rounded-bl-2xl flex px-2 py-1.5 items-center gap-4
                             border-defaultColor dark:border-defaultColor5">
                            <label for="woman">خانم</label>
                            <input type="radio" value="0" v-model="form.gender" :checked="!form.gender" id="woman"
                                   name="gender"
                                   class="text-defaultColor7 focus:ring-0 focus:ring-offset-0">
                            <label for="man">آقا</label>
                            <input type="radio" value="1" v-model="form.gender" :checked="form.gender" id="man"
                                   name="gender"
                                   class="text-defaultColor7 focus:ring-0 focus:ring-offset-0">
                        </div>
                    </div>
                    <panel-input label="شماره تماس :" :value="form.cellphone"
                                 @updateValue="(item)=>form.cellphone=item"
                                 placeholder-text="شماره تلفن خود را وارد کنید:"/>
                    <panel-input label="آدرس ایمیل :" type="email" :value="form.email"
                                 @updateValue="(item)=>form.email=item"
                                 placeholder-text="آدرس ایمیل خود را وارد کنید:"/>
                    <panel-input label="آدرس :" :value="form.address"
                                 @updateValue="(item)=>form.address=item"
                                 placeholder-text="آدرس خود را وارد کنید:"/>
                    <panel-input label="کد پستی :" :value="form.post_code"
                                 @updateValue="(item)=>form.post_code=item"
                                 placeholder-text="کد پستی خود را وارد کنید:"/>
                    <div class="grid items-center grid-cols-1 justify-center gap-4 *:px-6 *:py-2 *:h-fit *:rounded-xl *:shadow-md *:shadow-gray-600
                     *:text-white *:duration-300 hover:*:-translate-y-1 dark:*:shadow-gray-800 md:grid-cols-2 md:mt-8">
                        <button type="submit" class="bg-defaultColor dark:bg-defaultColor5">ثبت اطلاعات</button>
                        <button type="reset" class="bg-red-500 dark:bg-red-700">حذف اطلاعات</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
