<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Pages/Admin/Components/Pagination.vue";

const props = defineProps(["userData"]);
console.log(props.userData)
</script>

<template>

    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="overflow-scroll border h-fit border-current rounded-2xl text-xs sm:text-base">
            <table class="text-nowrap w-full table-auto md:table-fixed *:*:!pr-4 *:border-b last:border-none even:*:bg-adminColor1 *:border-current
             dark:even:*:bg-adminColor4">
                <tr class="h-14">
                    <td class="hidden md:table-cell w-[5%]">آیدی</td>
                    <td>نام و نام خانوادگی</td>
                    <td>نام کاربری</td>
                    <td class="text-center">عملیات</td>
                    <td class="w-[7%]">مقام</td>
                    <td class="hidden md:table-cell w-[7%]">جنسیت</td>
                    <td>شماره تماس</td>
                    <td class="hidden md:table-cell" >ایمیل</td>
                </tr>
                <tr v-for="user in userData.data" class="h-12 cursor-pointer hover:!bg-adminColor2 duration-500">
                    <td class="hidden md:table-cell w-[5%]">{{ user.id }}</td>
                    <td class="">{{ user.full_name === '' ? 'خالی' : user.full_name }}</td>
                    <td class="truncate">{{ user.user_name === '' ? 'خالی' : user.user_name }}</td>
                    <td class="flex pt-2 justify-center items-center"><span class="py-1 px-2 duration-500 bg-gray-500 rounded-lg relative hover:bg-gray-700">...</span></td>
                    <td class="w-[7%]">{{ user.is_admin ? 'مدیر' : 'کاربر' }}</td>
                    <td class="hidden md:table-cell w-[7%]">{{ user.gender === 1 ? 'آقا' : 'خانم' }}</td>
                    <td class="">{{ user.cellphone }}</td>
                    <td class="hidden md:table-cell truncate">{{ user.email }}</td>
                </tr>
            </table>
            <Pagination :links="userData.links" :meta="userData.meta"/>
        </div>
    </Layout>
</template>
