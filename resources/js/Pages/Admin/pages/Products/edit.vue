<script setup>

import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import axios, {toFormData} from "axios";
import {useToast} from "vue-toastification";
import AdminDataList from "@/Pages/Admin/Components/AdminDataList.vue";
import ProductVariationModal from "@/Pages/Admin/pages/Products/ProductVariationModal.vue";
import AdminActiveDeActiveInput from "@/Pages/Admin/Components/AdminActiveDeActiveInput.vue";

const props = defineProps({
    Product: null,
});
const VariationsData = ref(props.Product.data.variations);
const productImage = ref(props.Product.data.image);
const form = ref({
    id: props.Product.data.id,
    name: props.Product.data.name,
    brand: props.Product.data.brand,
    category: props.Product.data.category,
    description: props.Product.data.description,
    is_active: props.Product.data.is_active,
});
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
                const filteredData = VariationsData.value.filter(item => item.data !== undefined)
                filteredData.map((item, index) => {
                    if (item.data !== undefined) {
                        formData.append('variation[' + index + '][id]', item.data.id ?? -1);
                        formData.append('variation[' + index + '][size]', item.data.size);
                        formData.append('variation[' + index + '][weight]', item.data.weight);
                        formData.append('variation[' + index + '][price]', item.data.price);
                        formData.append('variation[' + index + '][quantity]', item.data.quantity);
                        formData.append('variation[' + index + '][off_sale]', item.data.off_sale);
                        if (typeof item.data.passedImages !== 'string')
                            item.data.passedImages.map((passedImage, passed_index) => {
                                formData.append('variation[' + index + '][passed_image][' + passed_index + '][id]', passedImage.id);
                                formData.append('variation[' + index + '][passed_image][' + passed_index + '][image]', passedImage.image);
                            });
                        item.images.forEach((imageItem, imageIndex) => {
                            formData.append('variation[' + index + '][image][' + imageIndex + ']', imageItem)
                        });
                    }
                });
                await axios.post(route('admin.products.update'), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                }).then((res) => {
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
const VariationDelete = (index) => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به حذف این سایز از محصول هستید؟'
        },
        listeners: {
            set: () => {
                document.getElementById('product_variation_modal' + index).style.display = 'none';
                VariationsData.value[index].data = undefined;
            }
        }
    }
    useToast().warning(content);
}
</script>


<template>
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
                    <AdminActiveDeActiveInput v-model="form.is_active"/>
                </div>
                <!--                brand & Categories section-->
                <div class="">
                    <!--                    Categories-->
                    <AdminDataList @selected="form.category=$event" :default_value="form.category" label="دسته بندی"
                                   route="categories.show"/>
                    <!--                    brands-->
                    <AdminDataList @selected="form.brand=$event" :default_value="form.brand" label="برند"
                                   route="brands.show"/>
                </div>
                <div class="!block !space-y-0">
                    <div class="pr-3">توضیحات :</div>
                    <textarea name="" id="" @input="(e)=>form.description = e.target.value"
                              class="admin_inputs">{{form.description}}</textarea>
                </div>
                <div class="flex !justify-center flex-wrap gap-5 !space-y-0">
                    <product-variation-modal v-for="(item, index) in VariationsData"
                                             :id="'product_variation_modal'+index" :variation_data="item"
                                             @delete="VariationDelete(index)" :key="index"
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
