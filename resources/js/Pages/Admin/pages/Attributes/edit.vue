<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
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
import AttributeConnectionItem from "@/Pages/Admin/Components/AttributeConnectionItem.vue";

const props = defineProps({
    attributeData: null,
});
console.log(props.attributeData.data)
const picture = ref(props.attributeData.data.icon);
const form = ref({
    id: props.attributeData.data.id,
    name: props.attributeData.data.name,
    description: props.attributeData.data.description,
    is_active: props.attributeData.data.is_active,
});
const passedConnection = {
    brands: props.attributeData.data.brands,
    categories: props.attributeData.data.categories,
    products: props.attributeData.data.products,
    products_variations: props.attributeData.data.product_variations,
}
const connections = ref({
    brands: props.attributeData.data.brands,
    categories: props.attributeData.data.categories,
    products: props.attributeData.data.products,
    products_variations: props.attributeData.data.product_variations,
})

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این خصوصیت هستید؟'
        },
        listeners: {
            set: async () => {
                const formData = new FormData();
                toFormData(form.value, formData);
                if (typeof picture.value !== 'string')
                    formData.append('image', picture.value.get('image'));
                else
                    formData.append('image', picture.value);
                connections.value.brands.map((item, index) => {
                    formData.append('brand[' + index + ']', item);
                });
                connections.value.categories.map((item, index) => {
                    formData.append('category[' + index + ']', item);
                });
                connections.value.products.map((item, index) => {
                    formData.append('product[' + index + ']', item);
                });
                connections.value.products_variations.map((item, index) => {
                    formData.append('product_variation[' + index + ']', item);
                });
                await axios.post(route('admin.attributes.update'), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                }).then(res => {
                    useToast().success('عملیات بروزرسانی خصوصیت موفقیت آمیز بود');
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
    <admin-header/>
    <admin-side-bar/>
    <Layout>
        <form @submit.prevent="sendData">
            <admin-picture-input v-model="picture"/>
            <div class="space-y-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-4 md:justify-between">
                    <AdminInput name="نام" v-model="form.name"/>
                    <admin-active-de-active-input v-model="form.is_active"/>
                </div>
                <AdminTextArea v-model="form.description"/>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.brands.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
                <div class="flex items-center flex-wrap gap-6 lg:justify-between">
                    <AttributeConnectionItem model-href="admin.brands.show" v-model="connections.brands"
                                             model-name="برند"/>
                    <AttributeConnectionItem model-href="admin.categories.show" v-model="connections.categories"
                                             model-name="دسته بندی"/>
                    <AttributeConnectionItem model-href="admin.products.show" v-model="connections.products"
                                             model-name="محصول"/>
                    <AttributeConnectionItem model-href="admin.productVariations.show"
                                             v-model="connections.products_variations" model-name="موجودیت محصول"/>
                </div>
            </div>
        </form>
    </Layout>
</template>
