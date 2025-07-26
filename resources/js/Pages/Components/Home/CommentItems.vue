<script setup>
const props = defineProps({
    comment: Object,
});
console.log(props.comment)
</script>

<template>
    <div class="space-y-2 border-4 rounded-xl p-2 border-defaultColor">
        <div class="flex gap-2 items-center ">
            <div class="size-12 rounded-full overflow-hidden">
                <img class="size-full" :src="comment.user_image" alt="عکس کاربر">
            </div>
            <div class="font-bold text-base">{{comment.user_name}} :</div>
        </div>
        <div class="text-base pr-2 w-full">{{comment.comment}}</div>
    </div>
</template>
