<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import Product from "@/Pages/Admin/Components/Product.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import {ref} from "vue";

const props = defineProps({
    products: null,
});
const productData = ref(props.products.data);
const productDeleted = (id) => {
    productData.value = productData.value.filter((item) => item.id !== id);
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="flex p-4 flex-wrap gap-10 justify-center">
            <Product v-for="item in productData" @deleted="productDeleted($event)" :product="item"/>
        </div>
        <Pagination :links="products.links" :meta="products.meta" create-link="admin.products.create"/>
    </Layout>
</template>
