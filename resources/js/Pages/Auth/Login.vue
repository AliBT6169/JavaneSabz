<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import CheckBoxBT from "@/Pages/Components/Form/CheckBoxBT.vue";
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";

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
    });
};
</script>

<template>
    <div class="w-screen h-screen bg-transparent">
        <div class="relative  mx-auto flex flex-col gap-10 h-full justify-center items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
            <video class="w-screen h-screen z-[-1] absolute top-0 left-0" autoplay loop>
                <source src="/videos/login.mp4">
            </video>

            <Head title="Log in"/>

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>
            <div class="flex justify-center items-center">
                <div class="flex flex-col justify-between size-96 rounded-l-2xl py-8 border-8 border-white">
                    <div class="text-lg w-full flex justify-center gap-6 items-center font-black">
                        <div class="w-1/4 grid grid-cols-4">
                            <div
                                class="size-10 rounded-full bg-defaultColor5 border-2 py-1.5 font-bold border-defaultColor text-defaultColor text-center"
                                v-for="item in 4">15K
                            </div>
                        </div>
                        <span class="text-defaultColor7 text-nowrap">به خانواده بزرگ جوانه سبز بپیوندید...</span>
                    </div>
                    <div class="flex items-center justify-center text-3xl text-defaultColor7 font-black w-full">
                        <span class="">دوست مهربان کشاورزان ایران</span>
                    </div>
                </div>
                <form @submit.prevent="submit">
                    <div class="flex flex-col size-96 rounded-r-lg overflow-hidden justify-center">
                        <div class="w-5/6 flex bg-white justify-center rounded-tl-full h-fit upComingAnimation">
                            <img src="../../../../public/logo/logo1.png" class="size-24" alt="">
                        </div>
                        <div class="w-full p-5 bg-white rounded-[40px] rounded-tr-none rounded-bl-none">
                            <input-BT2
                                Label="ایمیل:"
                                type="email"
                                v-model="form.email"
                                required
                            ></input-BT2>
                        </div>
                        <div class="w-full p-5 bg-white rounded-tr-[40px]">
                            <input-BT2
                                Label="رمز عبور:"
                                type="password"
                                v-model="form.password"
                                required
                            ></input-BT2>
                        </div>
                        <div class="w-full px-10 py-5 bg-white rounded-bl-[50px]">
                            <label class="flex items-center gap-2">
                                <span
                                    class="ms-2 text-sm text-gray-600 dark:text-gray-400">من را به یاد داشته باش</span>
                                <CheckBoxBT name="remember" v-model:checked="form.remember"/>
                            </label>
                        </div>

                        <div class="w-5/6 px-10 py-5 bg-white flex items-center justify-end rounded-bl-full">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none
                                 focus:ring-2 focus:ring-defaultColor focus:ring-offset-2 dark:text-gray-400
                                  dark:hover:text-defaultColor dark:focus:ring-offset-defaultColor"
                            >
                                فراموشی رمز عبور
                            </Link>

                            <ButtonBT2
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                ورود
                            </ButtonBT2>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
