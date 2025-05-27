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
            <img :src="'/'+(user.data.user_image===''?'images/default/default.jpg':user.data.user_image)" class="cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95" alt="">
            <div class="space-y-4">
                <AdminInput name="نام و نام خانوادگی" :default_value="user.data.full_name"/>
                <AdminInput name="نام کاربری" :default_value="user.data.user_name"/>
            </div>
            <div class="space-y-4">
                <AdminInput name="شماره تماس" :default_value="user.data.cellphone"/>
                <AdminInput name="ایمیل" :default_value="user.data.email"/>
            </div>
            <div class="space-y-4">
                <AdminInput name="کد پستی" :default_value="user.data.postal_code"/>
            </div>
        </div>
    </Layout>
</template>
