<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import CourseAdminItem from "@/Pages/Admin/Components/Courses/CourseAdminItem.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import axios from "axios";
import {useToast} from "vue-toastification";

const props = defineProps<{
    courses: {
        data: {
            id: number;
            title: string;
            subject: string;
            avatar: string;
            content: string;
            views: number;
        }[]
    }
}>()
const loading = ref<boolean>(false);
const coursesData = ref<{
    id: number;
    title: string;
    subject: string;
    avatar: string;
    content: string;
    views: number;
}[]>(props.courses.data);
const deleteCourse = (id: number) => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به حذف این آموزش هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.delete(route('admin.courses.destroy', {id: id})).then(res => {
                    loading.value = false;
                    useToast().success('حذف آموزش مورد نظر موفقیت آمیز بود!');
                    coursesData.value = coursesData.value.filter((item) => {
                        item.id === id
                    });
                }).catch(err => {
                    loading.value = false;
                    useToast().error(err.response.data.message)
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);
}
</script>

<template>
    <Layout>
        <LoadingComponent :loading="loading"/>
        <AdminCreateButton table-name="courses"/>
        <div class="space-y-5">
            <CourseAdminItem v-for="item in coursesData" @delete="deleteCourse($event)" :course="item"/>
        </div>
    </Layout>
</template>
