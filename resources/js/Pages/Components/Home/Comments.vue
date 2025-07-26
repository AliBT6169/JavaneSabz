<script setup>
import {ref} from "vue";
import CommentItems from "@/Pages/Components/Home/CommentItems.vue";

const props = defineProps({
    comments: Array | null,
    product_id: Number,
});
const form = ref({
    product_id: "",
    comment: ''
})
</script>

<template>
    <div class="space-y-2">
        <div class="pr-2 font-bold text-3xl">نظرات:</div>
        <div class="p-2 rounded-xl border-4 border-defaultColor">
            <div class="space-y-2 ">
                <div class="w-full">نظر خود را درمورد این محصول با ما در اشتراک بگذارید:</div>
                <input
                    placeholder="نظر خود را درمورد این محصول با ما در اشتراک بگذارید:"
                    class="w-full duration-150 rounded-xl border-2 !border-defaultColor bg-defaultColor4 focus:border-4 focus:ring-defaultColor placeholder-defaultColor5"
                    type="text" v-model="form.comment">
                <div class="flex justify-end">
                    <div
                        class="bg-defaultColor5 duration-300 px-10 py-1 cursor-pointer rounded-full w-fit text-white border-4 border-defaultColor hover:scale-95 ">
                        ثبت
                    </div>
                </div>
            </div>
            <CommentItems :comment="{
                user_name:'فرشید احسانی',
                comment:'خیلی خوبه این محصول من که راضیم'
            }"/>
        </div>
    </div>
</template>
