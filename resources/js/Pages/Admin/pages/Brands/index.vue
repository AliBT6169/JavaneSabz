<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    brands: null,
});
console.log(props.brands)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-6">
            <div v-for="item in brands.data"
                 class="text-center space-y-2 border-2 cursor-pointer border-black rounded-xl group p-2">
                <img :src="item.icon" alt=""
                     class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95">
                <div class="">{{ item.name }}</div>
                <div class="">{{ item.productsQuantity }} محصول</div>
            </div>
            <div class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                <svg-component name="plus" class="size-full"/>
            </div>
        </div>
    </Layout>
</template>
