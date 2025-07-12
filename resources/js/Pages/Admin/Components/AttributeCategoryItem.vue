<script setup>
const props = defineProps({
    category: {
        required: true,
    }
});
</script>

<template>
    <div class="border-2 cursor-pointer rounded-xl sm:!w-60 overflow-hidden space-y-4 ">
        <div class="size-40 sm:size-60">
            <img :src="category.icon" alt=""
                 class="size-full">
        </div>
        <div class="space-y-4 px-1 pb-2 *:flex *:justify-between *:items-center">
            <div class="">
                <div class="">نام:</div>
                <div class="">{{ category.name }}</div>
            </div>
            <div class="">
                <div class="">تعداد محصولات:</div>
                <div class="">{{ category.productsQuantity }}</div>
            </div>
        </div>
    </div>
</template>
