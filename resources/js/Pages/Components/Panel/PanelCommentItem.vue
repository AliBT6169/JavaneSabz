<script setup>
import {Link} from "@inertiajs/vue3";
const props = defineProps({
    commentData: {
        type: Object,
        required: true
    },
});

</script>

<template>

    <div class="space-y-5 rounded-xl border-2 border-defaultColor p-2 *:w-60 *:m-auto dark:border-defaultColor5 h-96 no-scrollbar overflow-y-scroll">
        <Link :href="route('ProductShow',{id:commentData.product.id})" class="">
            <img :src="commentData.product.image[0].image" :alt="commentData.product.name" class="size-60 rounded-xl cursor-pointer duration-300 hover:scale-95">
        </Link>
        <div class="flex gap-2 justify-between items-center text-sm">
            <div class="">نام : {{ commentData.product.name }}</div>
            <div class="">اندازه : {{ commentData.product.value }}</div>
        </div>
        <div class="flex text-sm justify-between gap-2 items-center">
            <div class="">تاریخ: </div>
            <div class="">{{commentData.created_at}}</div>
        </div>
        <div class="*:px-10 *:py-2 *:text-center *:rounded-xl *:border-2">
            <div v-if="commentData.status===0" class="border-yellow-500 bg-yellow-500/70">در انتظار تایید</div>
            <div v-if="commentData.status===1" class="border-green-500 bg-green-500/70">تایید شده</div>
            <div v-if="commentData.status===2" class="border-red-500 bg-red-500/70">رد شده</div>
        </div>
        <div class="space-y-2">
            <div class="text-xl font-bold">متن نظر:</div>
            <div class="">{{ commentData.comment }}</div>
        </div>
    </div>
</template>
