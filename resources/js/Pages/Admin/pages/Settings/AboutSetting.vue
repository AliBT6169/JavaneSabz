<script setup>
import {ref} from "vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {toFormData} from "axios";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import AdminPictureInput from "@/Pages/Admin/Components/AdminPictureInput.vue";
import AdminTextArea from "@/Pages/Admin/Components/AdminTextArea.vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const form = ref({
    address: props.settings.address ?? '',
    phone: props.settings.phone ?? '',
    email: props.settings.email ?? '',
    about: props.settings.about ?? '',
    facebook: props.settings.facebook ?? '',
    twitter: props.settings.twitter ?? '',
    instagram: props.settings.instagram ?? '',
    youtube: props.settings.youtube ?? '',
    telegram: props.settings.telegram ?? '',
    whatsapp: props.settings.whatsapp ?? '',
    eta: props.settings.eta ?? '',
});
const icon = ref(props.settings.icon);

const sendData = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره تغییرات هستید؟'
        },
        listeners: {
            set: async () => {
                const formData = ref(new FormData());
                formData.value = toFormData(form.value);
                if (typeof icon.value !== 'string')
                    formData.value.append("icon", icon.value.get('image'));
                else
                    formData.value.append("icon", icon.value);
                await axios.post(route('admin.settings.update'), formData.value, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-HTTP-Method-Override": "PUT",
                    }
                }).then(res => {
                    useToast().success(res.data);
                }).catch(err => {
                    useToast().error(err.response.data.message);
                });
            }
        }
    }
    useToast().warning(content);
}
</script>

<template>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}"
         class="adminSettingPagesDesign">
        <form @submit.prevent="sendData" class="pb-20">
            <AdminPictureInput v-model="icon"/>
            <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:*:w-[45%] md:space-y-0 md:justify-center">
                <AdminInput name="شماره تماس " v-model="form.phone"/>
                <AdminInput name="شماره تماس " v-model="form.phone"/>
                <AdminInput name="ایمیل " v-model="form.email"/>
                <AdminInput name="ایتا " v-model="form.eta"/>
                <AdminInput name="فیس بوک " v-model="form.facebook"/>
                <AdminInput name="توییتر " v-model="form.twitter"/>
                <AdminInput name="اینستاگرام " v-model="form.instagram"/>
                <AdminInput name="یوتیوب " v-model="form.youtube"/>
                <AdminInput name="تلگرام " v-model="form.telegram"/>
                <AdminInput name="واتساپ " v-model="form.whatsapp"/>
                <AdminTextArea label="درباره :" v-model="form.about"/>
                <div class="space-y-5 justify-end !w-full md:flex md:gap-5 *:md:w-48 md:space-y-0">
                    <AdminButton type="submit" text="ثبت اطلاعات"/>
                </div>
            </div>
        </form>
    </div>
</template>
