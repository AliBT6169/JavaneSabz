<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    comment: Object,
});

const form = ref({
    id: props.comment.id,
    status: props.comment.approved,
});
const changeStatus = (e) => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به انجام این عملیات هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.patch(route('admin.comments.change_status'), form.value).then(res => {
                    form.value.status = Number(e.target.value);
                    useToast().success('عملیات موفقیت آمیز بود');
                }).catch(err => {
                    console.log(err)
                });
            }
        }
    }
    useToast().warning(content);

}
</script>

<template>
    <div class="rounded-xl border-2 p-2 border-adminColor1 flex justify-between *:w-60 ">
        <div class="flex gap-2 items-center">
            <img :src="comment.user.image" alt="" class="size-14 rounded-full">
            <div class="">{{ comment.user.name }}</div>
        </div>
        <div class="flex gap-2 items-center">
            <img :src="comment.product_variation.image[0].image" alt="" class="size-14 rounded-full">
            <div class="">{{ comment.product_variation.name }}</div>
        </div>
        <div class="flex gap-2 items-center">
            <select class="rounded-xl cursor-pointer text-center" name="" id="" v-model="form.status"
                    @change="changeStatus"
                    :class="{
                        'bg-yellow-400':form.status===0,
                        'bg-green-500':form.status===1,
                        'bg-red-500':form.status===2
                    }">
                <option class="cursor-pointer bg-yellow-400" :selected="form.status===0" value="0">در انتظار تایید
                </option>
                <option class="cursor-pointer bg-green-400" :selected="form.status===1" value="1">تایید شده</option>
                <option class="cursor-pointer bg-red-400" :selected="form.status===2" value="2">تایید نشده</option>
            </select>
        </div>
        <div class="flex gap-2 items-center">
            <img :src="comment.user.image" alt="" class="size-14 rounded-full">
            <div class="">{{ comment.user.name }}</div>
        </div>
    </div>
</template>
