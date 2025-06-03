<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";

const props = defineProps({
    products: null,
});
console.log(props.products)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="flex p-4 flex-wrap gap-10 justify-center">
            <div v-for="item in products.data" class="pb-2 w-60 rounded-xl overflow-hidden border space-y-4">
                <img :src="item.image" class="w-full max-h-40 border" alt="">
                <div class="px-2 text-nowrap space-y-2 *:flex *:justify-between *:items-center *:gap-4 *:border-t *:rounded-t-xl">
                    <div class="">
                        <div class="">برند:</div>
                        <div class="">{{ item.brand }}</div>
                    </div>
                    <div class="">
                        <div class="">دسته بندی:</div>
                        <div class="">{{ item.category }}</div>
                    </div>
                    <div class="">
                        <div class="">نام محصول:</div>
                        <div class="">{{ item.name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
