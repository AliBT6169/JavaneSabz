<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    brandData: {
        required: true,
    }
});
const is_active = ref(props.brandData.is_active);
const toggle = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.patch(route('admin.brands.toggle', {id: props.brandData.id})).then(res => {
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
</script>

<template>

    <div
        class="text-center overflow-hidden space-y-2 border-2 cursor-pointer border-black rounded-xl group p-2">
        <Link class="relative flex h-1/3 lg:h-1/2 justify-center items-center" :href="route('admin.brands.edit',{id:brandData.id})">
            <img :src="brandData.icon" alt=""
                 class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95 h-full ">
            <div
                class="hidden lg:block p-2 xl:px-6 rounded-xl absolute bg-white/20 duration-300 translate-x-40 group-hover:translate-x-0
            dark:bg-gray-800/20">
                مشاهده
            </div>
        </Link>
        <div class="">{{ brandData.name }}</div>
        <div class="">{{ brandData.productsQuantity }} محصول</div>
        <div class="py-1 w-full rounded-lg border border-black"
             @click="toggle"
             :class="{'bg-green-500':is_active,'bg-red-500':!is_active }">
            {{ is_active ? 'فعال' : 'غیرفعال' }}
        </div>
    </div>
</template>

