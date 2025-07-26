<script setup>
import {ref} from "vue";
import CommentItems from "@/Pages/Components/Home/CommentItems.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    comments: Array | null,
    product_id: Number,
});
const form = ref({
    product_id: props.product_id,
    comment: ''
});
const sendData = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: "آیا مطمعن به ثبت این نظر هستید؟"
        },
        listeners: {
            set: async () => {
                await axios.post(route('Comment.store'), form.value).then((res) => {
                    useToast().success(res.data);
                }).catch((err) => {
                    console.log(err);
                });
            }
        }
    }
    useToast().warning(content);
}
</script>

<template>
    <div class="space-y-2">
        <div class="pr-2 font-bold text-3xl">نظرات:</div>
        <div class="p-2 rounded-xl border-4 border-defaultColor">
            <div class="space-y-2 ">
                <div class="w-full">نظر خود را درمورد این محصول با ما در اشتراک بگذارید:</div>
                <textarea
                    placeholder="نظر خود را اینجا بنویسید:"
                    class="w-full h-60 duration-150 rounded-xl border-2 !border-defaultColor bg-defaultColor4 focus:border-4
                    focus:ring-defaultColor placeholder-defaultColor5 dark:bg-defaultColor7"
                    v-model="form.comment"></textarea>
                <div class="flex justify-end">
                    <div @click="sendData"
                         class="bg-defaultColor5 duration-300 px-10 py-1 cursor-pointer rounded-full w-fit text-white border-4 border-defaultColor hover:scale-95 ">
                        ثبت
                    </div>
                </div>
            </div>
        </div>
        <CommentItems v-for="item in comments" :comment="item"/>
    </div>
</template>
