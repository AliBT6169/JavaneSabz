<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import AdminStatusInput from "@/Pages/Admin/Components/AdminStatusInput.vue";
import AdminTextArea from "@/Pages/Admin/Components/AdminTextArea.vue";
import AdminPictureInput from "@/Pages/Admin/Components/AdminPictureInput.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const form = ref({
    title: '',
    status: true,
    description: '',
    pictures: [
        '',
    ],
});

const sendData = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این بلاگ هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.post(route('admin.blogs.store'),).then(res => {
                    console.log(res.data)
                    useToast().success(res.data);
                }).catch(err => {
                    useToast().error(err.response.data.message)
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);

}

const addImage = () => {
    form.value.pictures.push('');
}

const onPictureDelete = (index) => {
    form.value.pictures.splice(index, 1);
    console.log(form.value.pictures);
}
</script>

<template>
    <Layout>
        <form @submit.prevent="sendData">
            <div
                class="space-y-6 py-4 ">
                <admin-input v-model="form.title" class="!w-60" name="موضوع"/>
                <div class="admin_inputs flex flex-wrap gap-5 justify-center">
                    <div class="relative flex justify-center items-center overflow-hidden size-40 group"
                         v-for="(item, index) in form.pictures">
                        <AdminPictureInput v-model="form.pictures[index]" :my-key="index"/>
                        <svg-component name="delete"
                                       @click="onPictureDelete(index)"
                                       class="size-7 rounded-xl p-1 absolute top-3 md:top-60 border cursor-pointer
                                       border-current duration-300 bg-gray-800/50 hover:bg-red-500/50 hover:text-red-500 md:group-hover:top-1"/>
                    </div>
                    <svg-component name="plus" class="cursor-pointer duration-300 size-40 hover:scale-95"
                                   @click="addImage"/>
                </div>
                <AdminStatusInput name="وضعیت :" v-model="form.status"/>
                <AdminTextArea v-model="form.description"/>
                <div class="space-y-2 md:space-y-0 md:flex md:gap-4 md:justify-end md:!w-[90%]">
                    <admin-button type="submit" text="ثبت"/>
                    <Link class="block" :href="route('admin.blogs.index')">
                        <admin-button type="cancel" text="لغو"/>
                    </Link>
                </div>
            </div>
        </form>
    </Layout>
</template>
