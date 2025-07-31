<script setup>
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const props = defineProps({
    settings: Object,
    is_active: Boolean,
});
const form = ref({
    address: props.settings.address ?? '',
    phone: props.settings.phone ?? '',
    email: props.settings.email ?? '',
    about: props.settings.about ?? '',
    facebook: props.settings.facebook ?? '',
    twitter: props.settings.twitter ?? '',
    instagram: props.settings.instagram ?? '',
    youtube: props.settings.youtube ?? '',
    telegram: props.settings.telegram ?? '',
    whatsapp: props.settings.whatsapp ?? '',
    eta: props.settings.eta ?? '',
});
const icon = ref(props.settings.icon);
const onFileChange = (event) => {
    const file = event.target.files[0];
    icon.value = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            icon.value = e.target.result;
        };
        reader.readAsDataURL(file);

    } else {
        icon.value = '';
    }
}
</script>

<template>
    <div :class="{'opacity-0 top-[-1000px] invisible':!is_active}" class="w-full absolute top-0 duration-300 border-adminColor2 border-4 rounded-xl p-5">
        <form @submit.prevent="" class="pb-20">
            <label for="image" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
                <input type="file" id="image" accept="*image/*" class="invisible absolute" @change="onFileChange">
                <img :src="icon === ''?'/images/default/product.png':icon"
                     class="size-full"
                     alt="">
            </label>
            <div class="space-y-5 md:flex md:flex-wrap md:gap-5 md:*:w-[45%] md:space-y-0 md:justify-center">
                <AdminInput name="شماره تماس " v-model="form.phone"/>
                <AdminInput name="شماره تماس " v-model="form.phone"/>
                <AdminInput name="ایمیل " v-model="form.email"/>
                <AdminInput name="درباره " v-model="form.about"/>
                <AdminInput name="فیس بوک " v-model="form.facebook"/>
                <AdminInput name="توییتر " v-model="form.twitter"/>
                <AdminInput name="اینستاگرام " v-model="form.instagram"/>
                <AdminInput name="یوتیوب " v-model="form.youtube"/>
                <AdminInput name="تلگرام " v-model="form.telegram"/>
                <AdminInput name="واتساپ " v-model="form.whatsapp"/>
                <AdminInput name="ایتا " v-model="form.eta"/>
                <div class="space-y-5 justify-end !w-full md:flex *:md:w-48 md:space-y-0">
                    <AdminButton type="submit" text="ثبت اطلاعات"/>
                    <AdminButton type="cancel" text="لغو"/>
                </div>
            </div>
        </form>
    </div>
</template>
