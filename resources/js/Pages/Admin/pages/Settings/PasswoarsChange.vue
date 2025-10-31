<script setup>
import {ref} from "vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    is_active: Boolean,
});
const form = ref({
    code: null,
    oldPassword: null,
    password: null,
    password_confirmation: null,
});
const status = ref(0);
const loading = ref(false);

const sendRequest = async () => {
    loading.value = true;
    await axios.get(route('admin.passwordChange.sendVerification')).then(res => {
        status.value = 1;
        loading.value = false;
    }).catch(err => {
        useToast().error(err.response.data.message);
        loading.value = false;
    });
}
const sendData = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به تغییر رمز عبور خود هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.post(route('admin.passwordChange.verifyAndChange', form.value))
                    .then(res => {
                        loading.value = false;
                        useToast().success('عملیات تغییر گذرواژه با موفقیت انجام شد.')
                        status.value = 0;
                        form.value.code = null;
                        form.value.oldPassword = null;
                        form.value.password = null;
                        form.value.password_confirmation = null;
                    }).catch(err => {
                        useToast().error(err.response.data.message);
                        loading.value = false;
                        status.value = 0;
                        form.value.code = null;
                        form.value.oldPassword = null;
                        form.value.password = null;
                        form.value.password_confirmation = null;
                    });
            }
        }
    }
    useToast().warning(content);
}
</script>

<template>
    <LoadingComponent :loading="loading"/>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}"
         class="adminSettingPagesDesign">
        <AdminButton class="m-auto block translate-y-60 opacity-0 invisible duration-300"
                     :class="{' !translate-y-0 !opacity-100 !visible':status===0}" @click="sendRequest"
                     :disabled="loading" text="درخواست تغییر رمز عبور"/>
        <form @submit.prevent="sendData" class="pb-20 translate-y-60 opacity-0 duration-300 invisible"
              :class="{'!visible !translate-y-0 !opacity-100':status===1}">
            <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:*:w-[45%] md:space-y-0 md:justify-center">
                <AdminInput name="کد ارسال شده" v-model="form.code"/>
                <AdminInput type="password" name="گذرواژه فعلی" v-model="form.oldPassword"/>
                <AdminInput type="password" name="گذرواژه جدید" v-model="form.password"/>
                <AdminInput type="password" name="تایید گذرواژه جدید" v-model="form.password_confirmation"/>
                <div class="space-y-5 justify-end !w-full md:flex md:gap-5 *:md:w-48 md:space-y-0">
                    <AdminButton type="submit" text="ثبت اطلاعات"/>
                </div>
            </div>
        </form>
    </div>
</template>
