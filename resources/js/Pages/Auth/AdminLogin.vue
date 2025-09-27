<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";
import {useToast} from "vue-toastification";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";

const AdminLogin = useForm({
    userName: '',
    password: '',
});

const submit = () => {
    AdminLogin.post(route('adminLoginStore'), {
        onError: (error) => {
            for (const errorKey in error) {
                useToast().error(error[errorKey])
            }
        }
    });

}
</script>

<template>
    <div class="w-screen h-screen bg-cover bg-center"
         style="background-image: url('../../../../images/default/login_back.jpg');">
        <div class="mx-auto flex flex-col gap-10 h-full justify-center items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
            <Head title="admin Login"/>
            <form class="w-full lg:w-1/2" @submit.prevent="submit">
                <div class="w-full bg-defaultColor5 bg-opacity-70 rounded-3xl text-defaultColor7 grid gap-5 pb-6">
                    <div class="flex flex-col items-center border-b-2 border-defaultColor">
                        <div class=" upComingAnimation">
                            <img :src="useIndexStore().Settings.settings.data.icon"
                                 class="w-28 scale-125" alt="">
                        </div>
                        <span class="text-2xl font-black">ورود مدیریت محترم</span>
                    </div>
                    <inputBT2
                               Label="نام کاربری: "
                               type="text"
                               v-model="AdminLogin.userName"
                               required
                    />
                    <inputBT2
                               Label="رمز عبور:"
                               type="password"
                               v-model="AdminLogin.password"
                               required
                    />
                    <div class="px-5 lg:flex gap-5 lg:justify-between lg:items-center">
                        <ButtonBT2
                            class="ms-4 text-defaultColor7"
                        >
                            ورود به حساب
                        </ButtonBT2>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
