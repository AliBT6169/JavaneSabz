<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useToast} from "vue-toastification";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    product: null,
});
const loading = ref(false);
const emit = defineEmits(['deleted']);
const is_active = ref(Boolean(props.product.is_active));
const ActiveDeActive = async () => {
    await axios.patch(route('admin.products.active_DeActive', {id: props.product.id})).then((res) => {
        useToast().success(res.data.message);
        is_active.value = !is_active.value;
    }).catch((err) => {
    });
}
const deleter = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا از حذف این محصول مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.delete(route('admin.products.destroy', {id: props.product.id})).then((res) => {
                    loading.value = false;
                    useToast().success('محصول با موفقیت حذف شد.');
                    emit('deleted', props.product.id);
                }).catch((err) => {
                    loading.value = false;
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
    <div class="pb-2 w-60 rounded-xl relative overflow-hidden border border-current space-y-4 cursor-pointer">
        <div @click="deleter"
             class="absolute p-1 rounded-xl left-1 duration-300 top-1 hover:text-red-500 bg-white/30 dark:bg-gray-800/30">
            <svg-component name="delete" class="size-6"/>
        </div>
        <img :src="product.image" class="!mt-0 w-60 h-40 border" alt="">
        <div
            class="px-2 text-nowrap space-y-2 *:flex *:justify-between *:products-center *:gap-4 *:border-t *:border-current *:rounded-t-xl">
            <div class="">
                <div class="">نام محصول:</div>
                <div class="">{{ product.name }}</div>
            </div>
            <div
                class="p-1 *:px-1 *:border *:cursor-pointer *:duration-300 *:rounded-3xl *:shadow-md *:shadow-gray-500 hover:*:scale-95">
                <Link :href="route('admin.products.edit',{id:product.id})"
                      class="bg-adminColor2">
                    تغییر اطلاعات
                    <svg-component name="edit" class="size-5 inline"/>
                </Link>
                <div class="bg-green-500 cursor-pointer" @click="ActiveDeActive"
                     :class="{'!bg-red-500':is_active===false}">
                    {{ is_active ? 'فعال' : 'غیر فعال' }}
                </div>
            </div>
            <div class="">
                <div class="">برند:</div>
                <div class="">{{ product.brand }}</div>
            </div>
            <div class="">
                <div class="">دسته بندی:</div>
                <div class="">{{ product.category }}</div>
            </div>
            <div class="!justify-start !gap-2 products-center flex-wrap pt-1">
                <div class="">سایزبندی:</div>
                <div v-for="(variation, index) in product.variations"
                     :class="{'border-l pl-2 border-current':product.variations.length-1> index}">
                    {{ variation.value }}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
