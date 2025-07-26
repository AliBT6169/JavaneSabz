<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {ref} from "vue";
import AdminCommentItem from "@/Pages/Admin/pages/Comments/AdminCommentItem.vue";

const props = defineProps({
    commentsData: Array,
});
const filteredData = ref(props.commentsData.data);
const filterData = (e) => {
    console.log(e);
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <AdminInput @update:modelValue="" name="جستجو"/>
        <div class="space-y-5">
            <AdminCommentItem v-for="item in filteredData" :comment="item"/>
        </div>
    </Layout>
</template>
