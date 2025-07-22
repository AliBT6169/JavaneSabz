<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import CategoryItem from "@/Pages/Admin/Components/CategoryItem.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const props = defineProps({
    categories: null,
});
const categoryData = ref(props.categories.data);
const filteredCategories = ref(props.categories.data);
const categoryDeleted = (id) => {
    categoryData.value = categoryData.value.filter((item) => item.id !== id);
    filteredCategories.value = categoryData.value.filter((item) => item.id !== id);
}
const searchKeyWord = ref("");
const searchKeyWordChanged = (e) => {
    filteredCategories.value = categoryData.value.filter((item) => item.name.includes(e));
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminInput v-model="searchKeyWord" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div class="space-y-5 lg:flex lg:space-y-0 lg:gap-6 lg:flex-wrap lg:items-center">
            <CategoryItem v-for="item in filteredCategories" @deleted="categoryDeleted($event)" :category-data="item"/>
            <div class="flex justify-center">
                <Link :href="route('admin.categories.create')"
                      class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                    <svg-component name="plus" class="size-40"/>
                </Link>
            </div>
        </div>
    </Layout>
</template>
