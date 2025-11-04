<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

const props = defineProps({
    brands: null,
});
const brandData = ref(props.brands.data);
const filteredBrands = ref(props.brands.data);
const brandDeleted = (id) => {
    brandData.value = brandData.value.filter((item) => item.id !== id);
    filteredBrands.value = brandData.value.filter((item) => item.id !== id);
}
const searchKeyWord = ref("");

const searchKeyWordChanged = (e) => {
    filteredBrands.value = brandData.value.filter((item) => item.name.includes(e));
}
const pageCount = ref({
    currentPage: props.brands.meta.current_page,
    from: props.brands.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="برند ها" :PageCount="pageCount"/>
        <AdminInput v-if="filteredBrands.length>0" v-model="searchKeyWord" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div v-if="filteredBrands.length>0" class="grid grid-cols-1 gap-5 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-7 2xl:grid-cols-8">
            <BrandItem v-for="item in filteredBrands" @deleted="brandDeleted($event)" :brand-data="item"/>
        </div>
        <div v-else class="text-center text-xl font-bold">هنوز برندی نساختید!</div>
            <AdminCreateButton table-name="brands"/>
    </Layout>
</template>
