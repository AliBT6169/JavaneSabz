<script setup>
import {ref} from "vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    comment: Object,
});
const loading = ref(false);

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
                loading.value = true;
                await axios.patch(route('admin.comments.change_status'), form.value).then(res => {
                    loading.value = false;
                    form.value.status = Number(e.target.value);
                    useToast().success('عملیات موفقیت آمیز بود');
                }).catch(err => {
                    loading.value = false;
                });
            }
        }
    }
    useToast().warning(content);

}
const commentVisibility = ref(false);
</script>

<template>
    <LoadingComponent :loading="loading"/>
    <div class="w-72 rounded-xl overflow-hidden border-2 p-2 border-adminColor1 duration-300 lg:w-full"
         :class="{'space-y-5':commentVisibility}">
        <div
            class="space-y-5 justify-between items-center lg:*:flex lg:*:gap-2 *:items-center *:text-center *:m-auto *:w-fit lg:flex lg:space-y-0 lg:*:w-60">
            <div class="">
                <img :src="comment.user.image" alt="" class="size-20 lg:size-14 rounded-full">
                <div class="">{{ comment.user.name }}</div>
            </div>
            <div class="!hidden lg:!block h-10 !w-1 rounded-full bg-gray-700"></div>
            <div class="">
                <div class="">{{ comment.created_at }}</div>
            </div>
            <div class="!hidden lg:!block h-10 !w-1 rounded-full bg-gray-700"></div>
            <div class="text-sm">
                <img :src="comment.product_variation.image[0].image" alt="" class="size-14 rounded-full">
                <div class="space-y-0.5">
                    <div class="">نام محصول :{{ comment.product_variation.name }}</div>
                    <div class="">اندازه محصول :{{ comment.product_variation.value }}</div>
                </div>
            </div>
            <div class="!hidden lg:!block h-10 !w-1 rounded-full bg-gray-700"></div>
            <div class="flex justify-end select-none">
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
                <div class="!w-fit pl-2">
                    <svg-component name="arrow-left" @click="commentVisibility = !commentVisibility"
                                   class="cursor-pointer duration-300 size-7"
                                   :class="{'-rotate-90':commentVisibility}"/>
                </div>
            </div>
        </div>
        <div class="duration-300 h-40 lg:h-20 overflow-y-scroll no-scrollbar"
             :class="{'!h-0 invisible opacity-0':!commentVisibility}">
            <div class="text-center">
                {{ comment.comment }}
            </div>
        </div>
    </div>
</template>
