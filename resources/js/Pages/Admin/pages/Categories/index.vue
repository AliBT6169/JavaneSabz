<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import CategoryItem from "@/Pages/Admin/Components/CategoryItem.vue";

const props = defineProps({
    categories: null,
});
console.log(props.categories)
const categoryData = ref(props.categories.data);
const brandDeleted = (id) => {
    categoryData.value = categoryData.value.filter((item) => item.id !== id);
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-6 xl:grid-cols-7 2xl:grid-cols-8">
            <CategoryItem v-for="item in categoryData" @deleted="categoryData($event)" :category-data="item"/>
            <Link :href="route('admin.categories.create')"
                  class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                <svg-component name="plus" class="size-full"/>
            </Link>
        </div>
    </Layout>
</template>
