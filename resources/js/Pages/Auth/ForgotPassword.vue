<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});
const submit = () => {
    form.post(route('password.email'));
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
                            <img :src="useIndexStore().Settings.icon"
                                 class="w-28 scale-125" alt="">
                        </div>
                        <span class="text-2xl font-black">بازیابی رمز عبور</span>
                    </div>
                    <div v-if="status==='We have emailed your password reset link.'" class="text-center text-defaultColor upComingAnimation font-bold ">ما لینک تغییر رمز عبور را برایتان ارسال کردیم</div>
                    <input-BT2
                        Label="ایمیل:"
                        type="email"
                        v-model="form.email"
                        required
                    ></input-BT2>
                    <div class="px-5 lg:flex gap-5 lg:justify-between lg:items-center">
                        <div class="flex justify-center pt-5 lg:justify-start">
                            <ButtonBT2
                                class="ms-4 text-white"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                ارسال لینک تغییر رمز عبور
                            </ButtonBT2>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
