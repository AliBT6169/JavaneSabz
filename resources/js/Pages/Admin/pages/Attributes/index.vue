<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";

const props = defineProps({
    attributes: {
        required: true,
    }
});
console.log(props.attributes);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AttributeItem v-for="item in 100" attribute="unknown"/>
    </Layout>
</template>
