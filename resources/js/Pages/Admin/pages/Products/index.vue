<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import Product from "@/Pages/Admin/Components/Product.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {Link} from "@inertiajs/vue3";

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
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminInput class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div class="flex p-4 flex-wrap gap-10 justify-center items-center">
            <Product v-for="item in productData" @deleted="productDeleted($event)" :product="item"/>
            <Link :href="route('admin.products.create')" class="size-40 text-8xl flex items-center justify-center border-2 rounded-xl border-adminColor1 duration-300 cursor-pointer hover:scale-95">+</Link>
        </div>
        <Pagination :links="products.links" :meta="products.meta" create-link="admin.products.create"/>
    </Layout>
</template>
