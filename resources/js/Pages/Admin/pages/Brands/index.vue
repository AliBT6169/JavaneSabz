<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";

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
    <Layout>
        <AdminInput v-model="searchKeyWord" class="!m-auto md:w-1/2" name="جستجو"
                    @update:modelValue="searchKeyWordChanged($event)"/>
        <div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-6 xl:grid-cols-7 2xl:grid-cols-8">
            <BrandItem v-for="item in filteredBrands" @deleted="brandDeleted($event)" :brand-data="item"/>
            <AdminCreateButton table-name="brands"/>
        </div>
    </Layout>
</template>
