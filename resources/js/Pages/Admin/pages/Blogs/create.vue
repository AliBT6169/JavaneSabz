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

const form = ref({
    title: '',
    status: true,
    description: '',
});
const preview = ref(null);

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این بلاگ هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.post(route('admin.blogs.store'),form.value).then(res => {
                    useToast().success(res.data.message);
                    preview.value.innerHTML = res.data.data;
                }).catch(err => {
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
        <form @submit.prevent="sendData">
            <div
                class="space-y-6 py-4 ">
                <admin-input v-model="form.title" class="!w-60" name="موضوع"/>
                <AdminStatusInput name="وضعیت :" v-model="form.status"/>
                <ckeditor :config="{language: 'fa'}" v-model="form.description"></ckeditor>
                <div ref="preview" class="w-full border-2 rounded-xl border-adminColor1 p-4 max-w-full overflow-hidden text-wrap">
                </div>
                <div class="size-20 rounded-xl bg-blue-500/50 " @click="dataShow"></div>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end md:!w-[90%]">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.blogs.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
            <Link :href="route('admin.blogs.edit',1)">صفحه تغییرات</Link>
        </form>
    </Layout>
</template>
