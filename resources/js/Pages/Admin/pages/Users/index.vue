<script setup>

import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(["userData"]);
console.log(props.userData)
</script>

<template>

    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="overflow-hidden border size-fit border-current rounded-2xl">
            <table class="w-full table-fixed *:*:!pr-4 *:border-b last:border-none even:*:bg-adminColor1 *:border-current
             dark:even:*:bg-adminColor4">
                <tr class="h-14">
                    <td>آیدی</td>
                    <td>نام و نام خانوادگی</td>
                    <td>جنسیت</td>
                    <td>شماره تماس</td>
                    <td>ایمیل</td>
                    <td>آدرس</td>
                    <td>کد پستی</td>
                </tr>
                <tr v-for="user in userData.data" class="h-12 cursor-pointer hover:!bg-adminColor2 duration-500">
                    <td class="">{{ user.id}}</td>
                    <td class="">{{ user.full_name === '' ? 'خالی' : user.full_name }}</td>
                    <td class="">{{ user.gender === 1 ? 'آقا' : 'خانم' }}</td>
                    <td class="">{{ user.cellphone }}</td>
                    <td class="truncate">{{ user.email }}</td>
                    <td class="truncate">
                        {{ user.address === '' ? 'خالی' : user.address }}
                    </td>
                    <td class="">{{ user.postal_code === '' ? 'خالی' : user.postal_code }}</td>
                </tr>
            </table>
            <div class="flex items-center justify-center gap-5 *:w-28 *:h-16 *:rounded-xl *:border *:border-gray-700/50
             *:bg-adminColor1 dark:*:bg-adminColor3">
                <Link v-if="userData.links.prev!==null" :href="userData.links.prev" class="">صفحه قبلی</Link>
                <Link :href="userData.links.first" class="">صفحه اول</Link>
                <Link :href="userData.links.next" class="">صفحه بعدی</Link>
                <Link :href="userData.links.last" class="">آخرین صفحه</Link>
            </div>
        </div>
    </Layout>
</template>
