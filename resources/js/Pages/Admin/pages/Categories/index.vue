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
const categoryData = ref(props.categories.data);
const categoryDeleted = (id) => {
    categoryData.value = categoryData.value.filter((item) => item.id !== id);
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="space-y-5">
            <CategoryItem v-for="item in categoryData" @deleted="categoryDeleted($event)" :category-data="item"/>
            <div class="flex justify-center">
                <Link :href="route('admin.categories.create')"
                      class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                    <svg-component name="plus" class="size-40"/>
                </Link>
            </div>
        </div>
    </Layout>
</template>
