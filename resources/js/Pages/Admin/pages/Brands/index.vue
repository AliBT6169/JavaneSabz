<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";

const props = defineProps({
    brands: null,
});
console.log(props.brands)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-6 xl:grid-cols-8">
            <BrandItem v-for="item in brands.data" :brand-data="item"/>
            <div class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                <svg-component name="plus" class="size-full"/>
            </div>
        </div>
    </Layout>
</template>
