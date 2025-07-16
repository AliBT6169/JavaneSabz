<script setup>
const props = defineProps({
    orderItem: {
        required: true,
    },
    modelValue: {
        type: Number,
    },
});
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div :class="{'border-2 rounded-xl p-1 size-fit border-red-500':modelValue>0}">
        <div
            class="border-gray-800 w-40 h-fit overflow-hidden border-2 space-y-4 rounded-xl text-black *:flex *:justify-between *:items-center *:px-2">
            <div class="!p-0">
                <img :src="typeof orderItem.images === 'string'?orderItem.images:orderItem.images[0].image" class="size-40">
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
                <div class="">{{ orderItem.weight }}</div>
            </div>
            <div class="">
                <div class="">قیمت:</div>
                <div class="">{{ orderItem.sale_price.toLocaleString('en-US') }}</div>
            </div>
            <div class="">
                <div class="">تعداد:</div>
                <div class="border rounded-xl flex *:px-2 overflow-hidden gap-3 items-center">
                    <div class="bg-red-500/50">+</div>
                    <div class="">{{orderItem.order_quantity}}</div>
                    <div class="bg-green-500/50 px-2">-</div>
                </div>
            </div>
        </div>
    </div>
</template>
