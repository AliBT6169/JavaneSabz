<script setup>
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const props = defineProps({
    user: null,
});
console.log(props.user.data)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="space-y-6">
            <img :src="'/'+user.data.user_image" class="cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95" alt="">
            <div class="">
                <AdminInput name="نام و نام خانوادگی" :default_value="user.data.full_name"/>
            </div>
        </div>
    </Layout>
</template>
