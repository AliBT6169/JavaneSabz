<script setup>
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminAddress from "@/Pages/Admin/Components/Admin-Address.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {ref} from "vue";

const props = defineProps({
    user: null,
});

const form = ref({
    full_name: props.user.data.full_name,
    user_name: props.user.data.user_name,
    image: props.user.data.user_image,
    gender: props.user.data.gender,
    email: props.user.data.email,
    cellphone: props.user.data.cellphone,
    postal_code: props.user.data.postal_code,
    city: props.user.data.address.city_id,
    address: props.user.data.address.address,
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
console.log(props.user.data)
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="pb-20">
            <label for="image" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
                <input type="file" id="image" accept="*image/*" class="invisible absolute" @change="onFileChange"
                       @input="(e)=>form.image = e.target.files[0]">
                <img :src="form.image === ''?'images/default/default.jpg':form.image"
                     class="size-full"
                     alt="">
            </label>
            <div
                class="space-y-6 *:space-y-6 *:md:space-y-0 *:md:flex *:md:justify-between *:md:items-center *:md:gap-6">
                <div class="">
                    <AdminInput name="نام و نام خانوادگی" @changed="(e)=>form.full_name=e"
                                :default_value="user.data.full_name"/>
                    <AdminInput name="نام کاربری" @changed="(e)=>form.user_name=e"
                                :default_value="user.data.user_name"/>
                </div>
                <div class="">
                    <AdminInput name="شماره تماس" @changed="(e)=>form.cellphone=e"
                                :default_value="user.data.cellphone"/>
                    <AdminInput name="ایمیل" @changed="(e)=>form.email=e"
                                :default_value="user.data.email"/>
                </div>
                <div class="">
                    <AdminInput name="کد پستی" @changed="(e)=>form.postal_code=e"
                                :default_value="user.data.postal_code"/>
                    <div class="w-full">
                        <div class="text-sm px-3">جنسیت :</div>
                        <div class="flex items-center gap-4 p-3 bg-adminColor1 rounded-lg border-adminColor2 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4">
                            <label for="man">آقا</label>
                            <input :checked="user.data.gender" @change="form.gender=1" type="radio" id="man"
                                   name="gender"
                                   class="text-adminColor2 cursor-pointer  focus:ring-0 dark:text-adminColor3">
                            <label for="woman">خانم</label>
                            <input :checked="!user.data.gender" @change="form.gender=0" type="radio" id="woman"
                                   name="gender"
                                   class="text-adminColor2 cursor-pointer focus:ring-0 dark:text-adminColor3">
                        </div>
                    </div>
                </div>
                <admin-address label="آدرس:" @update-value="(e)=>form.city=e" :address="user.data.address"/>
                <textarea name="" id="" @input="(e)=>form.address = e.target.value"
                          class="admin_inputs">{{user.data.address.address}}</textarea>
                <div class="*:text-center md:!justify-end">
                    <admin-button text="ثبت" type="submit" @click=""/>
                    <admin-button text="لغو" type="cancel" @click=""/>
                </div>
            </div>
        </div>
    </Layout>
</template>
