<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {ref} from "vue";
import AdminCommentItem from "@/Pages/Admin/pages/Comments/AdminCommentItem.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";

const props = defineProps({
    commentsData: Array,
});
const filteredData = ref(props.commentsData.data);
const filterData = async (e) => {
    await axios.get(route("admin.comments.search", {text: e === '' ? '***' : e})).then(res => {
        filteredData.value = res.data;
    }).catch(err => {

    });
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminInput @update:modelValue="filterData($event)" name="جستجو"/>
        <div class="flex  flex-wrap gap-5 justify-center lg:block lg:space-y-5">
            <AdminCommentItem v-for="item in filteredData" :comment="item"/>
        </div>
        <Pagination :links="commentsData.links" :meta="commentsData.meta"/>
    </Layout>
</template>
