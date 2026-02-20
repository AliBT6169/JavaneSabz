<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import {ref} from "vue";
import TipTapInput from "@/Pages/Components/Form/TipTapInput.vue";
import {Link, router} from "@inertiajs/vue3";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import axios from "axios";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const loading = ref<boolean>(false);
const contentData = ref<string>('');
const form = ref<{
    subject: string;
    title: string;
    content: string;
}>({
    subject: '',
    title: '',
    content: '',
});
const saveData = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این سفارش هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.post(route('admin.courses.store'), form.value).then(res => {
                    loading.value = false;
                    useToast().success(res.data);
                    router.get(route('admin.courses.index'));
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
        <loading-component :loading="loading"/>
        <div
            class="space-y-6 py-4 *:w-full *:h-fit md:space-y-0 md:flex md:flex-wrap md:items-center md:justify-center md:gap-5 *:md:w-[45%]">
            <admin-input v-model="form.subject" name="موضوع"/>
            <admin-input v-model="form.title" name="سرتیتر"/>
        </div>
        <TipTapInput v-model:content="form.content"/>
        <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end md:!w-[90%]">
            <admin-button type="submit" @click="saveData" text="ثبت"/>
            <Link class="block" :href="route('admin.courses.index')">
                <admin-button type="cancel" text="لغو"/>
            </Link>
        </div>
    </Layout>
</template>
