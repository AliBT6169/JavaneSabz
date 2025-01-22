<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputBT2 from "@/Pages/Components/Form/Input-BT2.vue";
import ButtonBT2 from "@/Pages/Components/Form/ButtonBT2.vue";
import CheckBoxBT from "@/Pages/Components/Form/CheckBoxBT.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register"/>
    <div class="w-screen h-screen bg-cover bg-center"
         style="background-image: url('../../../../images/slider/slider%20(6).jpeg');">
        <div class="mx-auto flex flex-col gap-10 h-full justify-center items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
            <Head title="Log in"/>
            <form class="w-full lg:w-1/2" @submit.prevent="submit">
                <div class="w-full bg-defaultColor5 bg-opacity-70 rounded-3xl text-defaultColor7 grid gap-5 pb-6">
                    <div class="flex flex-col items-center border-b-2 border-defaultColor">
                        <div class=" upComingAnimation">
                            <img src="../../../../public/logo/logo1.png"
                                 class="w-28 scale-125" alt="">
                        </div>

                        <span class="text-2xl font-black">به خانواده جوانه سبز  بپیوندید <svg-component name="like"
                                                                                                        class="size-5 inline"></svg-component></span>
                    </div>
                    <div class="">
                        <input-BT2
                            Label="نام کاربری:"
                            type="text"
                            v-model="form.name"
                            required
                        ></input-BT2>
                    </div>
                    <div class="">
                        <input-BT2
                            Label="ایمیل:"
                            type="email"
                            v-model="form.email"
                            required
                        ></input-BT2>
                    </div>
                    <div class="">
                        <input-BT2
                            Label="رمز عبور:"
                            type="password"
                            v-model="form.password"
                            required
                        ></input-BT2>
                    </div>
                    <div class="">
                        <input-BT2
                            Label="تائید رمز عبور:"
                            type="password_confirmation"
                            v-model="form.password_confirmation"
                            required
                        ></input-BT2>
                    </div>
                    <label class="*:pl-2 mx-auto lg:hidden">
                        <span class="duration-300 hover:text-defaultColor">من را به یاد داشته باش</span>
                        <CheckBoxBT name="remember" v-model:checked="form.remember"/>
                    </label>
                    <div class="px-5 lg:flex gap-5 justify-between w-full items-center">
                        <div class="grid gap-2">
                            <label class="*:pl-2 hidden lg:block">
                                <span class="duration-300 hover:text-defaultColor">من را به یاد داشته باش</span>
                                <CheckBoxBT name="remember" v-model:checked="form.remember"/>
                            </label>
                            <Link href="/login">
                                <div
                                    class="text-defaultColor7 duration-300 cursor-pointer hover:text-defaultColor underline"
                                    :class="{ 'opacity-25': form.processing }"
                                >
                                    حساب کاربری دارید؟
                                </div>
                            </Link>
                        </div>
                        <div class="flex justify-center lg:justify-start">
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
