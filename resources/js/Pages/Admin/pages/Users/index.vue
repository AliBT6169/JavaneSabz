<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";

const props = defineProps(["userData"]);
</script>

<template>

    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <table>
            <tr class="*:px-3 *:border-x *:border-black">
                <td>نام</td>
                <td>نام خانوادگی</td>
                <td>جنسیت</td>
                <td>شماره تماس</td>
                <td>ایمیل</td>
                <td>آدرس</td>
                <td>کد پستی</td>
            </tr>
            <tr v-for="users in userData.data">

            </tr>
        </table>
    </Layout>
</template>
