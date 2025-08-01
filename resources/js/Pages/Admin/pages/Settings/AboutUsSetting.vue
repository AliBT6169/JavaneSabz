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
    owner_name: props.settings.owner_name ?? '',
    owner_image: props.settings.owner_image ?? '',
    store_name: props.settings.store_name ?? '',
    store_image: props.settings.store_image ?? '',
    description: props.settings.description ?? '',
});
const icon = ref(props.settings.icon);
const onFileChange = (event) => {
    const file = event.target.files[0];
    icon.value = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            icon.value = e.target.result;
        };
        reader.readAsDataURL(file);

    } else {
        icon.value = '';
    }
}

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
         class="w-full absolute top-0 duration-1000 bg-adminColor1 border-adminColor2 border-4 rounded-xl p-5">
        <form @submit.prevent="sendData" class="pb-20">
            <AdminPictureInput v-model="form.store_image"/>
            <AdminPictureInput v-model="form.owner_image"/>
            <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:*:w-[45%] md:space-y-0 md:justify-center">
                <AdminInput name="نام صاحب وبسایت " v-model="form.phone"/>
                <AdminInput name="نام وبسایت " v-model="form.phone"/>
                <AdminTextArea label="توضیحات :" v-model="form.description"/>
                <div class="space-y-5 justify-end !w-full md:flex md:gap-5 *:md:w-48 md:space-y-0">
                    <AdminButton type="submit" text="ثبت اطلاعات"/>
                    <AdminButton type="cancel" text="لغو"/>
                </div>
            </div>
        </form>
    </div>
</template>
