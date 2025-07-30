<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import Product from "@/Pages/Admin/Components/Product.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {Link} from "@inertiajs/vue3";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

const props = defineProps({
    products: null,
});
const productData = ref(props.products.data);
const productDeleted = (id) => {
    productData.value = productData.value.filter((item) => item.id !== id);
}
const searchKeyWordChanged = (e) => {
    axios.get(route("admin.products.search", {name: e === '' ? '~' : e})).then((res) => {
        productData.value = res.data;
    }).catch((err) => {
        console.log(err);
    })
}
const pageCount = ref({
    currentPage: props.products.meta.current_page,
    from: props.products.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="محصولات" :PageCount="pageCount"/>
        <AdminInput v-if="productData.length>0" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div v-if="productData.length>0" class="flex p-4 flex-wrap gap-10 justify-center items-center">
            <Product v-for="item in productData" @deleted="productDeleted($event)" :product="item"/>
        </div>
        <div v-else class="text-center text-xl font-bold">محصولی موجود نیست!</div>
        <AdminCreateButton table-name="products"/>
        <Pagination :links="products.links" :meta="products.meta" create-link="admin.products.create"/>
    </Layout>
</template>
