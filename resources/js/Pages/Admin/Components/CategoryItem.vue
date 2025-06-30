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
        class="text-center border-2 cursor-pointer border-black rounded-xl group p-2 lg:space-y-6">
        <div class="space-y-2 lg:flex lg:space-y-0 lg:items-center lg:gap-6">
            <Link class="w-full relative flex justify-center items-center lg:w-60"
                  :href="route('admin.categories.edit',{id:categoryData.id})">
                <img :src="categoryData.icon" alt=""
                     class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95 size-32 ">
                <div class="hidden size-40 absolute rounded-xl overflow-hidden lg:flex justify-center items-center">
                    <div
                        class="p-2 xl:px-6 rounded-xl translate-x-40 group-hover:translate-x-0 bg-white/20 duration-300 dark:bg-gray-800/20">
                        مشاهده
                    </div>
                </div>
            </Link>
            <div class="flex gap-2 items-center border-b-2 pb-2 border-black dark:border-white lg:border-0 lg:p-0 lg:gap-6">
                <div class="w-full"><span class="lg:block">نام: </span>{{ categoryData.name }}</div>
                <div class="w-full"><span class="lg:block">تعداد محصول: </span>{{ categoryData.productsQuantity }}</div>
            </div>
            <div class="w-full lg:hidden"><span class="">توضیحات :</span>
                {{ categoryData.description }}
            </div>
            <div class="flex gap-2 items-center lg:block lg:space-y-2">
                <div class="py-1 w-full rounded-lg border border-black lg:px-10"
                     @click="toggle"
                     :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                    {{ is_active ? 'فعال' : 'غیرفعال' }}
                </div>
                <div @click="deleter"
                     class="p-1 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30 lg:w-full">
                    <svg-component name="delete" class="size-6 lg:m-auto"/>
                </div>
            </div>
        </div>
        <div class="w-full hidden lg:block"><span class="">توضیحات :</span>
            {{ categoryData.description }}
        </div>
    </div>
</template>

