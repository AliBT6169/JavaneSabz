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
        <div class="pb-6">
            <img :src="'/'+(user.data.user_image===''?'images/default/default.jpg':user.data.user_image)" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95" alt="">
            <div class="space-y-6 *:space-y-6 *:md:space-y-0 *:md:flex *:md:justify-between *:md:items-center *:md:gap-6">
                <div class="">
                    <AdminInput name="نام و نام خانوادگی" :default_value="user.data.full_name"/>
                    <AdminInput name="نام کاربری" :default_value="user.data.user_name"/>
                </div>
                <div class="">
                    <AdminInput name="شماره تماس" :default_value="user.data.cellphone"/>
                    <AdminInput name="ایمیل" :default_value="user.data.email"/>
                </div>
                <div class="">
                    <AdminInput name="کد پستی" :default_value="user.data.postal_code"/>
                    <div class="w-full">
                        <div class="text-sm px-3">جنسیت :</div>
                        <div class="flex items-center gap-4 p-3 bg-adminColor1 rounded-lg border-adminColor2 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4">
                            <label for="man">آقا</label>
                            <input :checked="user.data.gender" type="radio" id="man" name="gender"
                                   class="text-adminColor2 cursor-pointer  focus:ring-0 dark:text-adminColor3">
                            <label for="woman">خانم</label>
                            <input :checked="!user.data.gender" type="radio" id="woman" name="gender"
                                   class="text-adminColor2 cursor-pointer focus:ring-0 dark:text-adminColor3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
