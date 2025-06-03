<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import Product from "@/Pages/Admin/Components/Product.vue";

const props = defineProps({
    products: null,
});
console.log(props.products)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="flex p-4 flex-wrap gap-10 justify-center">
            <Product v-for="item in products.data" :product="item"/>
        </div>
    </Layout>
</template>
