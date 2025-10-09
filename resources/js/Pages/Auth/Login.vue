<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";
import {useToast} from "vue-toastification";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import {ref} from "vue";
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import login from "@/Pages/Auth/Login.vue";

const formStatus = ref(0);
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
const interval = ref(null);
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
const timer = ref(0);

const timerHandle = () => {
        clearInterval(interval.value);
        interval.value = null;
        timer.value = 120;
        interval.value = setInterval(() => {
                if (timer.value > 0) {
                    timer.value -= 1;
                }
                if (timer.value <= 0) {
                    clearInterval(interval.value);
                    interval.value = null;
                }
            }, 1000
        );
    }
;
const submit = (resend = false) => {
    if (formStatus.value === 0 || resend)
        axios.post(route('sendLoginSMSCode'), SendSMSForm).then((res) => {
            if (res.data.status === 50)
                window.location.href = 'adminLogin';
            if (res.data.user_exists) {
                formStatus.value = 1;
                LoginForm.mobile = res.data.mobile;
            } else {
                formStatus.value = 2;
                RegisterForm.mobile = res.data.mobile;
            }
            timerHandle();
        }).catch((err) => {
            useToast().error(err.response.data.message)
        });
    else if (formStatus.value === 1)
        LoginForm.post(route('sendVerificationCode'), {
            onError: (error) => {
                useToast().error(error.code);
            }
        });
    else if (formStatus.value === 2)
        RegisterForm.post(route('sendVerificationCode'), {
            onError: (error) => {
                for (const errorKey in error) {
                    useToast().error(error[errorKey])
                }
            }
        });

}

const resendCode = () => {
    submit(true);
}
</script>

<template>
    <div class="w-screen h-screen bg-cover bg-center"
         style="background-image: url('../../../../images/default/login_back.jpg');">
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
                               Label="نام کاربری(انگلیسی):"
                               type="text"
                               v-model="RegisterForm.name"
                    />
                    <input-BT2 v-if="formStatus===2"
                               Label="نام و نام خانوادگی:"
                               type="text"
                               v-model="RegisterForm.full_name"
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
                    <div class="px-5 lg:flex gap-5 lg:justify-between lg:items-center *:cursor-pointer">
                        <div v-if="formStatus >0" class="space-y-1 text-blue-800">
                            <div v-if="timer>0" class="">{{ timer }} تا ارسال مجدد کد</div>
                            <div v-else class="" @click="resendCode">ارسال مجدد کد تایید</div>
                            <div @click="formStatus = 0" class="underline">ویرایش شماره</div>
                        </div>
                        <ButtonBT2
                            class="ms-4 text-defaultColor7"
                        >
                            {{ formStatus === 0 ? 'دریافت کد یکبار مصرف' : 'ورود به حساب' }}
                        </ButtonBT2>
                    </div>
                    <div class="flex gap-3 items-center justify-center">
                        <Link class="" :href="route('privacy-policy')">حریم خصوصی و امنیت</Link>
                        <div class="h-8 w-[2px] bg-gray-800"></div>
                        <Link class="" :href="route('terms-conditions')">شرایط و خدمات</Link>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
