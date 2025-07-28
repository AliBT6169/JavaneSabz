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

const props = defineProps({
    brandData: null
});
console.log(props.brandData)
const picture = ref(props.brandData.data.icon);
const form = ref({
    id: props.brandData.data.id,
    name: props.brandData.data.name,
    is_active: props.brandData.data.is_active
});

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این برند هستید؟'
        },
        listeners: {
            set: async () => {
                const formData = new FormData();
                toFormData(form.value, formData);
                if (typeof picture.value !== "string")
                    formData.append('image', picture.value.get('image'));
                else
                    formData.append('image', picture.value);
                console.log(formData)
                await axios.post(route('admin.brands.update'), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                }).then(res => {
                    useToast().success('عملیات موفقی آمیز بود');
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
            <admin-picture-input v-model="picture"/>
            <div class="space-y-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-4 md:justify-between">
                    <AdminInput name="نام" v-model="form.name"/>
                    <admin-active-de-active-input v-model="form.is_active"/>
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
