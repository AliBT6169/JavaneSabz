<script setup>
const props = defineProps({
    product: {
        required: true,
    }
});
</script>

<template>
    <div class="border-2 cursor-pointer rounded-xl sm:!w-60 overflow-hidden space-y-4 ">
        <div class="size-40 sm:size-60">
            <img :src="product.image" alt=""
                 class="size-full">
        </div>
        <div class="space-y-4 px-1 pb-2 *:flex *:justify-between *:items-center">
            <div class="">
                <div class="">نام:</div>
                <div class="">{{ product.name }}</div>
            </div>
            <div class="">
                <div class="">برند:</div>
                <div class="">{{ product.brand }}</div>
            </div>
            <div class="">
                <div class="">دسته بندی:</div>
                <div class="">{{ product.category }}</div>
            </div>
        </div>
    </div>
</template>
