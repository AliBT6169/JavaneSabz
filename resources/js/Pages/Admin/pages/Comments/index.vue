<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {ref} from "vue";
import AdminCommentItem from "@/Pages/Admin/pages/Comments/AdminCommentItem.vue";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

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
const pageCount = ref({
    currentPage: props.commentsData.meta.current_page,
    from: props.commentsData.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="نظرات" :PageCount="pageCount"/>
        <AdminInput v-if="filteredData.length>0" @update:modelValue="filterData($event)" name="جستجو"/>
        <div v-if="filteredData.length>0" class="flex flex-wrap gap-5 justify-center lg:block lg:space-y-5">
            <AdminCommentItem v-for="item in filteredData" :comment="item"/>
        </div>
        <div v-else class="text-center text-xl font-bold">هنوز نظری در مورد محصولات داده نشده!</div>
        <Pagination :links="commentsData.links" :meta="commentsData.meta"/>
    </Layout>
</template>
