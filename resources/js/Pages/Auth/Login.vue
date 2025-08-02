<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import CheckBoxBT from "@/Pages/Components/Form/CheckBoxBT.vue";
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";
import {useToast} from "vue-toastification";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
        onError: (err) =>{
            const toast = useToast();
            toast.error(Object.values(err)[0]);
        },
    });
};
</script>

<template>
    <div class="w-screen h-screen bg-cover bg-center"
         style="background-image: url('../../../../images/slider/slider%20(6).jpeg');">
        <div class="mx-auto flex flex-col gap-10 h-full justify-center items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
            <Head title="Log in"/>
            <form class="w-full lg:w-1/2" @submit.prevent="submit">
                <div class="w-full bg-defaultColor5 bg-opacity-70 rounded-3xl text-defaultColor7 grid gap-5 pb-6">
                    <div class="flex flex-col items-center border-b-2 border-defaultColor">
                        <div class=" upComingAnimation">
                            <img :src="useIndexStore().Settings.settings.data.icon"
                                 class="w-28 scale-125" alt="">
                        </div>
                        <span class="text-2xl font-black">ورود به حساب کاربری</span>
                    </div>
                    <input-BT2
                        Label="ایمیل:"
                        type="email"
                        v-model="form.email"
                        required
                    ></input-BT2>
                    <input-BT2
                        Label="رمز عبور:"
                        type="password"
                        v-model="form.password"
                        required
                    ></input-BT2>
                    <div class="px-5 lg:flex gap-5 lg:justify-between lg:items-center">
                        <div class="grid gap-2">
                            <label class="*:pl-2">
                                <span class="duration-300 hover:text-defaultColor">من را به یاد داشته باش</span>
                                <CheckBoxBT name="remember" v-model:checked="form.remember"/>
                            </label>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="duration-300 underline hover:text-defaultColor"
                            >
                                فراموشی رمز عبور
                            </Link>
                        </div>
                        <div class="flex justify-center pt-5 lg:justify-start">
                            <Link href="/register">
                                <div
                                    class="ms-4 text-defaultColor7 duration-500 bg-blue-500 flex justify-center items-center
                                     w-20 h-10 cursor-pointer shadow shadow-slate-800 rounded-lg
                                           hover:saturate-200"
                                    :class="{ 'opacity-25': form.processing }"
                                >
                                    ثبت نام
                                </div>
                            </Link>
                            <ButtonBT2
                                class="ms-4 text-defaultColor7"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                ورود
                            </ButtonBT2>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
