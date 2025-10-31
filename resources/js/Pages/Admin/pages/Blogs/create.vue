<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import AdminStatusInput from "@/Pages/Admin/Components/AdminStatusInput.vue";
import {component as ckeditor} from '@mayasabha/ckeditor4-vue3';
import {Link} from "@inertiajs/vue3";
import AdminPictureInput from "@/Pages/Admin/Components/AdminPictureInput.vue";
import {toFormData} from "axios";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const form = ref({
    title: '',
    status: 1,
    description: '',
});
const icon = ref('');
const preview = ref(null);
const loading = ref(false);

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این بلاگ هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                const formData = new FormData();
                toFormData(form.value, formData);
                if (icon.value !== '')
                    formData.append('icon', icon.value.get('image'));
                else
                    formData.append('icon', icon.value);
                await axios.post(route('admin.blogs.store'), formData).then(res => {
                    loading.value = false;
                    useToast().success(res.data.message);
                    preview.value.innerHTML = res.data.data;
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
            <div
                class="space-y-6 py-4 ">
                <admin-input v-model="form.title" class="!w-60" name="موضوع"/>
                <AdminStatusInput name="وضعیت :" v-model="form.status"/>
                <AdminPictureInput v-model="icon"/>
                <ckeditor :config="{language: 'fa'}" v-model="form.description"></ckeditor>
                <div ref="preview"
                     class="w-full border-2 rounded-xl border-adminColor1 p-4 max-w-full overflow-hidden text-wrap">
                </div>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end md:!w-[90%]">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.blogs.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
