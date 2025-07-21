<script setup>

const props = defineProps({
    orderItem: {
        required: true,
    },
});
</script>

<template>
    <div
        class="border-gray-800 w-40 h-fit pb-2 overflow-hidden border-2 space-y-4 rounded-xl text-black *:flex *:justify-between *:items-center *:px-2">
        <div class="!p-0">
            <img :src="typeof orderItem.images === 'string'?orderItem.images:orderItem.images[0].image"
                 class="size-40">
        </div>
        <div class="">
            <div class="">نام:</div>
            <div class="">{{ orderItem.name }}</div>
        </div>
        <div class="">
            <div class="">اندازه:</div>
            <div class="">{{ orderItem.value }}</div>
        </div>
        <div class="">
            <div class="">وزن:</div>
            <div class="">{{ orderItem.weight.toLocaleString('en-US') }}</div>
        </div>
        <div class="">
            <div class="">قیمت:</div>
            <div class="">{{ orderItem.price.toLocaleString('en-US') }}</div>
        </div>
        <div class="">
            <div class="">تعداد:</div>
            <div class="">{{ orderItem.count}}</div>
        </div>
    </div>
</template>
