<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AdminBlogItem from "@/Pages/Admin/pages/Blogs/AdminBlogItem.vue";

const props = defineProps({
    blogs: Array,
});
const blogDeleted = (id) => {
    console.log(id)
    props.blogs.data = props.blogs.data.filter((blog) => blog.id !== id);
}
</script>

<template>
    <Layout>
        <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:justify-center md:items-center">
            <div class="w-full flex justify-center md:size-fit">
                <div class="w-60">
                    <AdminCreateButton table-name="blogs"/>
                </div>
            </div>
            <AdminBlogItem v-for="item in blogs.data" @deleted="blogDeleted(item.id)" :blog="item"/>
        </div>
    </Layout>
</template>
