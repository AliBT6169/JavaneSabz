<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    brands: null,
});
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-6 xl:grid-cols-7 2xl:grid-cols-8">
            <BrandItem v-for="item in brands.data" :brand-data="item"/>
            <Link :href="route('admin.brands.create')" class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                <svg-component name="plus" class="size-full"/>
            </Link>
        </div>
    </Layout>
</template>
