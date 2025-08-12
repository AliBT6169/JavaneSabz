<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";

const props = defineProps({
    blogs: Array,
})
</script>

<template>
    <Layout>
        <div class="flex gap-5 justify-center items-center">
            <AdminCreateButton table-name="blogs"/>
        </div>
    </Layout>
</template>
