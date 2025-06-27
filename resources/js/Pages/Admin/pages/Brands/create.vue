<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminPictureInput from "@/Pages/Admin/Components/AdminPictureInput.vue";
import {ref} from "vue";

const picture = ref('');
</script>

<template>
    <admin-header/>
    <admin-side-bar/>
    <Layout>
        <admin-picture-input v-model="picture" @click="console.log(picture.get('image'))"/>
    </Layout>
</template>
