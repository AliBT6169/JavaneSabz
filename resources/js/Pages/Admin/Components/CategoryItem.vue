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
        class="text-center overflow-hidden space-y-2 border-2 cursor-pointer border-black rounded-xl group p-2">
        <Link class="relative flex h-1/3 justify-center items-center"
              :href="route('admin.categories.edit',{id:categoryData.id})">
            <img :src="categoryData.icon" alt=""
                 class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95 h-full ">
            <div
                class="hidden lg:block p-2 xl:px-6 rounded-xl absolute bg-white/20 duration-300 translate-x-40 group-hover:translate-x-0
            dark:bg-gray-800/20">
                مشاهده
            </div>
        </Link>
        <div class="">{{ categoryData.name }}</div>
        <div class="">{{ categoryData.productsQuantity }} محصول</div>
        <div class=""><span class="">توضیحات :</span>
        {{ categoryData.description}}</div>
        <div class="flex gap-2 items-center">
            <div class="py-1 w-full rounded-lg border border-black"
                 @click="toggle"
                 :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                {{ is_active ? 'فعال' : 'غیرفعال' }}
            </div>
            <div @click="deleter"
                 class="p-1 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30">
                <svg-component name="delete" class="size-6"/>
            </div>
        </div>
    </div>
</template>

