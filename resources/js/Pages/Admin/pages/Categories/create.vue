<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPictureInput from "@/Pages/Admin/Components/AdminPictureInput.vue";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminActiveDeActiveInput from "@/Pages/Admin/Components/AdminActiveDeActiveInput.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import {toFormData} from "axios";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import AdminTextArea from "@/Pages/Admin/Components/AdminTextArea.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const picture = ref('');
const loading = ref(false);
const form = ref({
    name: '',
    description: '',
    is_active: 1
});

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این دسته بندی هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                const formData = new FormData();
                toFormData(form.value, formData);
                if (picture.value !== '')
                    formData.append('image', picture.value.get('image'));
                else
                    formData.append('image', picture.value);
                await axios.post(route('admin.categories.store'), formData).then(res => {
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
                    <admin-active-de-active-input v-model="form.is_active"/>
                </div>
                <div class="space-y-2">
                    <AdminTextArea v-model="form.description"/>
                </div>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.categories.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
