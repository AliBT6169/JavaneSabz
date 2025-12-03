<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPictureInput from "@/Pages/Admin/Components/AdminPictureInput.vue";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import axios, {toFormData} from "axios";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import AdminTextArea from "@/Pages/Admin/Components/AdminTextArea.vue";
import {EquipmentInterface} from "./Index.vue";

const props = defineProps<{
    equipment: EquipmentInterface;
}>();
const picture = ref<FormData | string | null>(props.equipment.iconPath ?? '');
const form = ref({
    id: props.equipment.id,
    name: props.equipment.name,
    description: props.equipment.description,
});
const loading = ref(false);

const sendData = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ویرایش این جزئیات هستید؟'
        },
        listeners: {
            set: () => {
                loading.value = true;
                const formData = new FormData();
                formData.append('_method', 'PUT');
                toFormData(form.value, formData);
                if (picture.value !== null && picture.value !== undefined && typeof picture.value !== "string")
                    formData.append('icon', picture.value.get('image'));
                else
                    formData.append('iconPath', picture.value);
                axios.post(route('admin.equipments.update'), formData).then(res => {
                    loading.value = false;
                    useToast().success('عملیات موفقی آمیز بود');
                }).catch(err => {
                    loading.value = false;
                    useToast().error(err.response.data.message)
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);

}
</script>

<template>
    <Layout>
        <LoadingComponent :loading="loading"/>
        <form @submit.prevent="sendData">
            <admin-picture-input v-model="picture"/>
            <div class="space-y-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-4 md:justify-between">
                    <AdminInput name="نام" v-model="form.name"/>
                </div>
                <div class="space-y-6 w-full">
                    <AdminTextArea v-model="form.description" label="توضیحات"/>
                </div>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.brands.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
