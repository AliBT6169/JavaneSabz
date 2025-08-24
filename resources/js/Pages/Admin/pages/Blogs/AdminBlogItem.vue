<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    blog: {
        type: Object,
        required: true,
    }
});
const emit = defineEmits({
    deleted: {}
});
const deleteBlog = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: "آیا مطمعن به حذف این وبلاگ هستید؟",
        },
        listeners: {
            set: async () => {
                axios.delete(route('admin.blogs.destroy', props.blog.id)).then(res => {
                    emit("deleted");
                    useToast().success(res.data);
                }).catch((err) => {
                    useToast().error(err.message);
                    console.error(err);
                });
            }
        }
    }
    useToast().warning(content);
}
</script>

<template>
    <div class="w-full relative group space-y-2  rounded-xl overflow-hidden border-4 border-adminColor2 md:size-60">
        <img :src="blog.icon" alt="" class="size-full">
        <div class="w-full bottom-5 absolute">
            <div class="px-4 py-1 m-auto w-fit rounded-xl bg-adminColor1/70 dark:bg-adminColor4/60">{{
                    blog.title
                }}
            </div>
        </div>
        <svg-component name="delete" @click="deleteBlog"
                       class="cursor-pointer size-7 rounded-full p-1 bg-adminColor1/50 absolute duration-500 top-2 left-0 md:-top-20
                        hover:text-red-500 md:group-hover:top-2 dark:bg-adminColor4/50"/>
        <Link class="block cursor-pointer size-7 rounded-full p-1 bg-adminColor1/50 absolute duration-500 top-2 md:-top-80 left-8
                        hover:text-blue-500 md:group-hover:top-2 dark:bg-adminColor4/50"
              :href="route('admin.blogs.edit',blog.id)">
            <svg-component name="edit" class="size-full"/>
        </Link>
    </div>
</template>
