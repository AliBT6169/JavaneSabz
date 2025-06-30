<script setup>

import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import {onMounted, ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import axios, {toFormData} from "axios";
import {useToast} from "vue-toastification";
import AdminDataList from "@/Pages/Admin/Components/AdminDataList.vue";
import ProductVariationModal from "@/Pages/Admin/pages/Products/ProductVariationModal.vue";

const VariationsData = ref([]);
const productImage = ref('');
const form = ref({
    name: '',
    brand: '',
    category: '',
    description: '',
    is_active: 1,
})
const onFileChange = (event) => {
    const file = event.target.files[0];
    productImage.value = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            productImage.value = e.target.result;
        };
        reader.readAsDataURL(file);

    } else {
        productImage.value = '';
    }
}
const saveChanges = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ساخت این محصول هستید؟'
        },
        listeners: {
            set: async () => {
                const formData = new FormData();
                toFormData(form.value, formData);
                if (document.querySelector('#image').files[0] != null)
                    formData.append('image', document.querySelector('#image').files[0]);
                VariationsData.value.map((item, index) => {
                    if (item.data !== undefined) {
                        formData.append('variation[' + index + '][size]', item.data.size);
                        formData.append('variation[' + index + '][weight]', item.data.weight);
                        formData.append('variation[' + index + '][price]', item.data.price);
                        formData.append('variation[' + index + '][quantity]', item.data.quantity);
                        formData.append('variation[' + index + '][off_sale]', item.data.off_sale);
                        item.images.forEach((imageItem, imageIndex) => {
                            formData.append('variation[' + index + '][image][' + imageIndex + ']', imageItem)
                        });
                    }
                });
                await axios.post(route('admin.products.store'), formData).then((res) => {
                    toast.success('عملیات موفقیت آمیز بود')
                }).catch((err) => {
                    toast.error(err.response.data.message)
                })
            }
        }
    }
    let toast = useToast();
    toast.warning(content)
}
const VariationDataChanged = (index, value) => {
    VariationsData.value[index] = value;
}
</script>


<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <form @submit.prevent="saveChanges" class="pb-20">
            <label for="image" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
                <input type="file" id="image" accept="*image/*" class="invisible absolute" @change="onFileChange">
                <img :src="productImage === ''?'/images/default/product.png':productImage"
                     class="size-full"
                     alt="">
            </label>
            <div
                class="space-y-6 *:space-y-6 *:md:space-y-0 *:md:flex *:md:justify-between *:md:items-center *:md:gap-6">
                <div class="">
                    <AdminInput name="نام محصول" v-model="form.name"/>
                    <div class="w-full">
                        <div class="text-sm px-3">وضعیت :</div>
                        <div class="flex items-center gap-4 p-3 bg-adminColor1 rounded-lg border-adminColor2 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4">
                            <label for="active">فعال</label>
                            <input checked @change="form.is_active=1" type="radio" id="active"
                                   name="is_active"
                                   class="text-adminColor2 cursor-pointer  focus:ring-0 dark:text-adminColor3">
                            <label for="de_active">غیر فعال</label>
                            <input @change="form.is_active=0" type="radio" id="de_active"
                                   name="is_active"
                                   class="text-adminColor2 cursor-pointer focus:ring-0 dark:text-adminColor3">
                        </div>
                    </div>
                </div>
                <!--                brand & Categories section-->
                <div class="">
                    <!--                    Categories-->
                    <AdminDataList @selected="form.category=$event" label="دسته بندی" route="categories.show"/>
                    <!--                    brands-->
                    <AdminDataList @selected="form.brand=$event" label="برند" route="brands.show"/>
                </div>
                <div class="!block !space-y-0">
                    <div class="pr-3">توضیحات :</div>
                    <textarea name="" id="" @input="(e)=>form.description = e.target.value"
                              class="admin_inputs">{{form.description}}</textarea>
                </div>
                <div class="flex !justify-center flex-wrap gap-5 !space-y-0">
                    <product-variation-modal v-for="(item, index) in VariationsData" variation_data=""
                                             @delete="VariationsData.splice(index,1)"
                                             @dataSend="VariationDataChanged(index,$event)" :component_index="index"/>
                    <div class="py-10 px-12 rounded-xl cursor-pointer bg-black/30 text-5xl"
                         @click="()=>VariationsData.push([])">+
                    </div>
                </div>
                <div class="*:text-center md:!justify-end *:my-2">
                    <admin-button text="ثبت" type="submit"/>
                    <Link :href="route('admin.products.index')">
                        <admin-button text="لغو" type="cancel"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
