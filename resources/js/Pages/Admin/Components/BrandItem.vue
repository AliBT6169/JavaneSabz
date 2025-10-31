<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    brandData: {
        required: true,
    }
});
const emit = defineEmits(['deleted']);
const loading = ref(false);
const is_active = ref(props.brandData.is_active);
const toggle = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.patch(route('admin.brands.toggle', {id: props.brandData.id})).then(res => {
                    loading.value = false;
                    useToast().success(res.data.message);
                    is_active.value = !is_active.value;
                }).catch(err => {
                    loading.value = false;
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
            message: 'آیا از حذف این برند مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.delete(route('admin.brands.destroy', {id: props.brandData.id})).then((res) => {
                    loading.value = false;
                    useToast().success('برند با موفقیت حذف شد.');
                    emit('deleted', props.brandData.id);
                }).catch((err) => {
                    loading.value = false;
                    useToast().error(err.response.data.message);
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);
}
</script>

<template>
        <LoadingComponent :loading="loading"/>

    <div
        class="text-center overflow-hidden space-y-2 border-2 cursor-pointer border-black rounded-xl p-2">
        <div class="size-32 m-auto">
            <img :src="brandData.icon" alt=""
                 class="rounded-full border-2 border-adminColor1 h-full">
        </div>
        <div class="">{{ brandData.name }}</div>
        <div class="">{{ brandData.productsQuantity }} محصول</div>
        <div class="space-y-2">
            <div class="py-1 w-full rounded-lg border border-black"
                 @click="toggle"
                 :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                {{ is_active ? 'فعال' : 'غیرفعال' }}
            </div>
            <Link class="bg-adminColor1 block py-1 w-full rounded-lg border border-black"
                  :href="route('admin.brands.edit',{id:brandData.id})">
                عملیات
            </Link>
            <div @click="deleter"
                 class="p-1 flex justify-center items-center gap-4 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30">
                حذف
                <svg-component name="delete" class="size-6"/>
            </div>
        </div>
    </div>
</template>

