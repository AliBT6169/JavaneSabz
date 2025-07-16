<script setup>
const props = defineProps({
    orderItem: {
        required: true,
    }
});
</script>

<template>

    <div
        class="border-gray-800 w-40 h-fit overflow-hidden border-2 space-y-4 rounded-xl text-black *:flex *:justify-between *:items-center *:px-2">
        <div class="!p-0">
            <img :src="orderItem.product_image" class="size-40">
        </div>
        <div class="">
            <div class="">نام:</div>
            <div class="">{{ orderItem.product_name }}</div>
        </div>
        <div class="">
            <div class="">اندازه:</div>
            <div class="">{{ orderItem.product_size }}</div>
        </div>
        <div class="">
            <div class="">وزن:</div>
            <div class="">{{ orderItem.product_weight }}</div>
        </div>
        <div class="">
            <div class="">قیمت:</div>
            <div class="">{{ orderItem.price.toLocaleString('en-US') }}</div>
        </div>
    </div>
</template>

<style scoped>

</style>
