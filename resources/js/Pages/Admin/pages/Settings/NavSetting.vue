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
});

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
                if (typeof owner_image.value !== 'string')
                    formData.value.append("owner_image", owner_image.value.get('image'));
                else
                    formData.value.append("owner_image", owner_image.value);
                if (typeof store_image.value !== 'string')
                    formData.value.append("store_image", store_image.value.get('image'));
                else
                    formData.value.append("store_image", store_image.value);
                console.log(formData.value);
                await axios.post(route('admin.aboutUsSetting.update'), formData.value, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-HTTP-Method-Override": "PUT",
                    }
                }).then(res => {
                    useToast().success(res.data)
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
            <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:*:w-[45%] md:space-y-0 md:justify-center">

                <div class="space-y-5 justify-end !w-full md:flex md:gap-5 *:md:w-48 md:space-y-0">
                    <AdminButton type="submit" text="ثبت اطلاعات"/>
                    <AdminButton type="cancel" text="لغو"/>
                </div>
            </div>
        </form>
    </div>
</template>
