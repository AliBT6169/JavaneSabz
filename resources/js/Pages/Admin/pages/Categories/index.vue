<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import CategoryItem from "@/Pages/Admin/Components/CategoryItem.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

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
const pageCount = ref({
    currentPage: props.categories.meta.current_page,
    from: props.categories.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="دسته بندی ها" :PageCount="pageCount"/>
        <AdminInput v-if="filteredCategories.length>0" v-model="searchKeyWord" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div v-if="filteredCategories.length>0"
             class="space-y-5 lg:flex lg:space-y-0 lg:gap-6 lg:flex-wrap lg:items-center">
            <CategoryItem v-for="item in filteredCategories" @deleted="categoryDeleted($event)" :category-data="item"/>
        </div>
        <div v-else class="text-center text-xl font-bold">هنوز دسته بندی نساختید!</div>
            <AdminCreateButton table-name="categories"/>
    </Layout>
</template>
