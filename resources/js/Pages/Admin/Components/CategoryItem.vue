<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    categoryData: {
        required: true,
    }
});
const emit = defineEmits(['deleted']);
const is_active = ref(props.categoryData.is_active);
const toggle = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.patch(route('admin.categories.toggle', {id: props.categoryData.id})).then(res => {
                    useToast().success(res.data.message);
                    is_active.value = !is_active.value;
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
    let toast = useToast();
    toast.warning(content);
}
const deleter = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا از حذف این دسته بندی مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.delete(route('admin.categories.destroy', {id: props.categoryData.id})).then((res) => {
                    useToast().success('دسته بندی با موفقیت حذف شد.');
                    emit('deleted', props.categoryData.id);
                }).catch((err) => {
                    useToast().error(err.response.data.message);
                    console.log(err);
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);
}
</script>

<template>

    <div
        class="text-center w-60 h-96 border-2 border-black rounded-xl p-2 lg:space-y-6 *:m-auto *:w-full">
        <div class="space-y-2">
            <img :src="categoryData.icon" alt=""
                 class="rounded-full duration-300 border-2 border-adminColor1 size-28 m-auto">
            <div
                class="">
                <div class="">{{ categoryData.name }}</div>
                <div class="">{{ categoryData.productsQuantity }}</div>
            </div>
            <div class="w-full lg:hidden"><span class="">توضیحات :</span>
                {{ categoryData.description }}
            </div>
            <div class="flex gap-2 cursor-pointer items-center lg:block lg:space-y-2">
                <div class="py-1 w-full rounded-lg border border-black lg:px-10"
                     @click="toggle"
                     :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                    {{ is_active ? 'فعال' : 'غیرفعال' }}
                </div>
                <Link class="py-1 bg-adminColor2 block w-full rounded-lg border border-black lg:px-10"
                      :href="route('admin.categories.edit',{id:categoryData.id})">
                    پیکربندی
                </Link>
                <div @click="deleter"
                     class="p-1 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30 lg:w-full">
                    <svg-component name="delete" class="size-6 lg:m-auto"/>
                </div>
            </div>
        </div>
        <div :title="categoryData.description" class="w-full hidden lg:block truncate"><span class="">توضیحات :</span>
            {{ categoryData.description }}
        </div>
    </div>
</template>

