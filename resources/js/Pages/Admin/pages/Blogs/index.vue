<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AdminBlogItem from "@/Pages/Admin/pages/Blogs/AdminBlogItem.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";
import {ref} from "vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";

const props = defineProps({
    blogs: Array,
});
const blogDeleted = (id) => {
    console.log(id)
    props.blogs.data = props.blogs.data.filter((blog) => blog.id !== id);
}
const pageCount = ref({
    currentPage: props.blogs.meta.current_page,
    from: props.blogs.meta.last_page,
});
</script>

<template>
    <Layout>
        <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:justify-center md:items-center">
            <AdminPageShower PageName="وبلاگ ها" :PageCount="pageCount"/>
            <div class="w-full flex justify-center md:size-fit">
                <div class="w-60">
                    <AdminCreateButton table-name="blogs"/>
                </div>
            </div>
            <AdminBlogItem v-for="item in blogs.data" @deleted="blogDeleted(item.id)" :blog="item"/>
        </div>
        <Pagination :links="blogs.links" :meta="blogs.meta" :create-link="'admin.blogs.create'"/>
    </Layout>
</template>
