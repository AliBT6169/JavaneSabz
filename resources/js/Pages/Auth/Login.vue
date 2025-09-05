<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import CheckBoxBT from "@/Pages/Components/Form/CheckBoxBT.vue";
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";
import {useToast} from "vue-toastification";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import {ref} from "vue";

const formStatus = ref(0);
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const SendSMSForm = useForm({
    mobile: '',
});

const RegisterForm = useForm({
    mobile: '',
    name: '',
    full_name: '',
    code: '',
});

const LoginForm = useForm({
    mobile: '',
    code: '',
});

const submit = () => {
    if (formStatus.value === 0)
        axios.post(route('sendLoginSMSCode'), SendSMSForm).then((res) => {
            console.log(res);
            if (res.data.user_exists) {
                formStatus.value = 1;
                LoginForm.mobile = res.data.mobile;
            } else {
                formStatus.value = 2;
                RegisterForm.mobile = res.data.mobile;
            }


        }).catch((err) => {
            console.log(err.response.data);
        });
    else if (formStatus.value === 1)
        axios.post(route('sendVerificationCode'), LoginForm).then((res) => {
            console.log(res);
        }).catch((err) => {
            console.log(err.response.data);
        });
    else if (formStatus.value === 2)
        axios.post(route('sendVerificationCode'), RegisterForm).then((res) => {
            console.log(res);
        }).catch((err) => {
            console.log(err.response.data);
        });

}
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
                        <span class="text-2xl font-black">{{ formStatus < 2 ? 'ورود به' : 'ساخت ' }} حساب کاربری</span>
                    </div>
                    <input-BT2 v-if="formStatus===0"
                               Label="شماره موبایل:"
                               type="text"
                               v-model="SendSMSForm.mobile"
                               required
                    />
                    <input-BT2 v-if="formStatus===2"
                               Label="نام کاربری:"
                               type="text"
                               v-model="RegisterForm.name"
                               required
                    />
                    <input-BT2 v-if="formStatus===2"
                               Label="نام و نام خانوادگی:"
                               type="text"
                               v-model="RegisterForm.full_name"
                               required
                    />
                    <input-BT2 v-if="formStatus===1"
                               Label="کد یکبار مصرف:"
                               type="text"
                               v-model="LoginForm.code"
                               required
                    />
                    <input-BT2 v-if="formStatus===2"
                               Label="کد یکبار مصرف:"
                               type="text"
                               v-model="RegisterForm.code"
                               required
                    />
                    <div class="px-5 lg:flex gap-5 lg:justify-between lg:items-center">
                        <ButtonBT2
                            class="ms-4 text-defaultColor7"
                        >
                            {{ formStatus === 0 ? 'دریافت کد یکبار مصرف' : 'ورود به حساب' }}
                        </ButtonBT2>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
