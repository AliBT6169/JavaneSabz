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
    <div class="w-screen h-screen bg-cover bg-center"
         style="background-image: url('../../../../images/slider/slider%20(6).jpeg');">
        <div class="mx-auto flex flex-col gap-10 h-full justify-center items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
            <Head title="Log in"/>
            <form class="w-1/2" @submit.prevent="submit">
                <div class="w-full bg-defaultColor5 bg-opacity-70 rounded-3xl text-defaultColor7">
                    <div class="flex flex-col items-center border-b-2 border-defaultColor">
                        <div class=" upComingAnimation">
                            <img src="../../../../public/logo/logo1.png"
                                           class="w-8 md:w-12 lg:w-20 xl:w-24 scale-125" alt="">
                        </div>

                        <span class="text-2xl font-black">ورود به حساب کاربری</span>
                    </div>
                    <div class="placeholder-defaultColor p-5">
                        <input-BT2
                            Label="ایمیل:"
                            type="email"
                            v-model="form.email"
                            required
                        ></input-BT2>
                    </div>
                    <div class="placeholder-defaultColor p-5">
                        <input-BT2
                            Label="رمز عبور:"
                            type="password"
                            v-model="form.password"
                            required
                        ></input-BT2>
                    </div>
                    <div class="p-5 flex justify-between w-full items-center">
                        <div class="grid">
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
                        <div class="px-2">
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
