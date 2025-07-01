<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";

const props = defineProps({
    Attributes: {
        required: true,
    }
});
console.log(props.Attributes);
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AttributeItem v-for="item in Attributes.data" :Attribute="item"/>
    </Layout>
</template>
