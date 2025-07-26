<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import SvgComponent from "@/Pages/Components/svg-component.vue";

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
const commentVisibility = ref(false);
</script>

<template>
    <div class="rounded-xl overflow-hidden border-2 p-2 border-adminColor1 space-y-5 h-20 duration-300"
         :class="{'h-40':commentVisibility}">
        <div class="flex justify-between *:w-60 *:flex *:gap-2 *:items-center">
            <div class="">
                <img :src="comment.user.image" alt="" class="size-14 rounded-full">
                <div class="">{{ comment.user.name }}</div>
            </div>
            <div class="">
                <img :src="comment.product_variation.image[0].image" alt="" class="size-14 rounded-full">
                <div class="">{{ comment.product_variation.name }}</div>
            </div>
            <div class="">
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
            <div class="justify-end pl-2">
                <svg-component name="arrow-left" @click="commentVisibility = !commentVisibility" class="cursor-pointer duration-300 size-7"
                               :class="{'-rotate-90':commentVisibility}"/>
            </div>
        </div>
        <div class="flex gap-2 items-center ">
            <div class="">
                {{ comment.comment }}
            </div>
        </div>
    </div>
</template>
