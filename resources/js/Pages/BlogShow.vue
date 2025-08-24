<script setup>

import IndexLyout from "@/Pages/IndexLyout.vue";
import {onMounted, ref} from "vue";

const props = defineProps({
    blog: Object,
});
const content = ref(null);
onMounted(() => {
    content.value.innerHTML = props.blog.data.description;
});

</script>

<template>
    <IndexLyout>
        <div class="space-y-5 w-full">
            <h1 class="text-3xl w-fit font-bold m-auto bg-gray-700/50 px-20 py-1 rounded-xl">
                {{ blog.data.title }}</h1>
            <img :src="blog.data.icon" class="m-auto w-1/2 rounded-2xl" alt="">
            <div ref="content" class=""></div>
            <div class="border-y-2 border-defaultColor5 p-5 flex justify-between items-center">
                <div class="">{{ 'تاریخ: ' + blog.data.created_at }}</div>
                <div class="">{{ 'تعداد بازدید: ' + blog.data.views }}</div>
            </div>
        </div>
    </IndexLyout>
</template>
