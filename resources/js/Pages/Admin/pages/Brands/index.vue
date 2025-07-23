<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const props = defineProps({
    brands: null,
});
const brandData = ref(props.brands.data);
const filteredBrands = ref(props.brands.data);
const brandDeleted = (id) => {
    brandData.value = brandData.value.filter((item) => item.id !== id);
}
const searchKeyWord = ref("");

const searchKeyWordChanged = (e) => {
    filteredBrands.value = brandData.value.filter((item) => item.name.includes(e));
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminInput v-model="searchKeyWord" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-6 xl:grid-cols-7 2xl:grid-cols-8">
            <BrandItem v-for="item in filteredBrands" @deleted="brandDeleted($event)" :brand-data="item"/>
            <Link :href="route('admin.brands.create')"
                  class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                <svg-component name="plus" class="size-full"/>
            </Link>
        </div>
    </Layout>
</template>
