<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

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
                await axios.get(route('admin.brands.toggle', {id: props.brandData.id})).then(res => {
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
        class="text-center space-y-2 border-2 cursor-pointer border-black rounded-xl group p-2">
        <img :src="brandData.icon" alt=""
             class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95">
        <div class="">{{ brandData.name }}</div>
        <div class="">{{ brandData.productsQuantity }} محصول</div>
        <div class="py-1 rounded-lg border border-black"
             @click="toggle"
             :class="{'bg-green-500':is_active,'bg-red-500':!is_active }">
            {{ is_active ? 'فعال' : 'غیرفعال' }}
        </div>
    </div>
</template>

