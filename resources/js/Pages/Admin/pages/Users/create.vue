<script setup>

import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import AdminAddress from "@/Pages/Admin/Components/Admin-Address.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import axios from "axios";
import {useToast} from "vue-toastification";

const form = new ref({
    full_name: '',
    user_name: '',
    image: '',
    gender: 1,
    email: '',
    password: '',
    password_confirmation: '',
    cellphone: '',
    post_code: '',
    city: '',
    address: '',
})
const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            form.value.image = e.target.result;
        };
        reader.readAsDataURL(file);

    } else {
        form.value.image = '';
    }
}
const saveChanges = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ساخت این کاربر هستید؟'
        },
        listeners: {
            set: async () => {
                if (form.value.password === form.value.password_confirmation) {
                    const formData = new FormData();
                    Object.entries(form.value).forEach(([key, value]) => {
                        formData.append(key, value);
                    });
                    formData.append('image', document.querySelector('#image').files[0]);
                    console.log(formData)
                    await axios.post(route('admin.users.store'), formData).then((res) => {
                        console.log(res.data);
                        toast.success('عملیات موفقیت آمیز بود')
                    }).catch((err) => {
                        toast.error(err.response.data.message)
                        console.log(err.response)
                    })
                } else {
                    toast.error('رمز عبور باید با تائید رمز عبور یکی باشد!');
                }
            }
        }
    }
    let toast = useToast();
    toast.warning(content)
}
</script>


<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <form @submit.prevent="saveChanges" class="pb-20">
            <label for="image" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
                <input type="file" id="image" accept="*image/*" class="invisible absolute" @change="onFileChange"
                       @input="(e)=>form.image = e.target.files[0]">
                <img :src="form.image === ''?'/images/default/default.jpg':form.image"
                     class="size-full"
                     alt="">
            </label>
            <div
                class="space-y-6 *:space-y-6 *:md:space-y-0 *:md:flex *:md:justify-between *:md:items-center *:md:gap-6">
                <div class="">
                    <AdminInput name="نام و نام خانوادگی" v-model="form.full_name"/>
                    <AdminInput name="نام کاربری" v-model="form.user_name"/>
                </div>
                <div class="">
                    <AdminInput name="شماره تماس" v-model="form.cellphone"/>
                    <AdminInput name="ایمیل" v-model="form.email"/>
                </div>
                <div class="">
                    <AdminInput type="password" name="رمز عبور" v-model="form.password"/>
                    <AdminInput type="password" name="تایید رمز عبور" v-model="form.password_confirmation"/>
                </div>
                <div class="">
                    <AdminInput name="کد پستی" v-model="form.post_code"/>
                    <div class="w-full">
                        <div class="text-sm px-3">جنسیت :</div>
                        <div class="flex items-center gap-4 p-3 bg-adminColor1 rounded-lg border-adminColor2 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4">
                            <label for="man">آقا</label>
                            <input checked @change="form.gender=1" type="radio" id="man"
                                   name="gender"
                                   class="text-adminColor2 cursor-pointer  focus:ring-0 dark:text-adminColor3">
                            <label for="woman">خانم</label>
                            <input @change="form.gender=0" type="radio" id="woman"
                                   name="gender"
                                   class="text-adminColor2 cursor-pointer focus:ring-0 dark:text-adminColor3">
                        </div>
                    </div>
                </div>
                <admin-address label="آدرس:" @update-value="form.city=$event" :address="form.address"/>
                <textarea name="" id="" @input="(e)=>form.address = e.target.value"
                          class="admin_inputs">{{form.address}}</textarea>
                <div class="*:text-center md:!justify-end">
                    <admin-button text="ثبت" type="submit" @click="saveChanges"/>
                    <Link :href="route('admin.users.index')">
                        <admin-button text="لغو" type="cancel"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
