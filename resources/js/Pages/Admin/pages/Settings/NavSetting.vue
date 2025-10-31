<script setup>
import {ref} from "vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {toFormData} from "axios";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import NavSettingItem from "@/Pages/Admin/pages/Settings/NavSettingItem.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const NavSettings = ref(props.settings);
const form = ref({});
const loading = ref(false);

const sendData = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره تغییرات هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
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
                await axios.post(route('admin.aboutUsSetting.update'), formData.value, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-HTTP-Method-Override": "PUT",
                    }
                }).then(res => {
                    loading.value = false;
                    useToast().success(res.data)
                }).catch(err => {
                    loading.value = false;
                    useToast().error(err.response.data.message);
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
        <form @submit.prevent="sendData" class="pb-20">
            <div class="flex flex-wrap gap-5 justify-center">
                <NavSettingItem v-for="item in NavSettings" :my-key="item.id" @move="NavSettings = $event"
                                :setting="item"/>
            </div>
        </form>
    </div>
</template>
