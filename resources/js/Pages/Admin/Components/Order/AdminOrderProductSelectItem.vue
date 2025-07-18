<script setup>
import {useToast} from "vue-toastification";

const props = defineProps({
    orderItem: {
        required: true,
    },
    modelValue: {
        type: Number,
    },
});
const emit = defineEmits(["update:modelValue", "deleteFromOrder", "addToOrder"]);
const quantityUpdate = (status) => {
    if (status === 'plus') {
        if (props.modelValue === 0)
            emit('addToOrder');
        if (props.modelValue < props.orderItem.quantity)
            emit('update:modelValue', props.modelValue + 1);
        else
            useToast().error('موجودی محصول در انبار کافی نیست!')
    } else if (status === 'minus') {
        if (props.modelValue === 1)
            emit('deleteFromOrder');
        emit('update:modelValue', props.modelValue - 1);
    }
}
</script>

<template>
    <div :class="{'border-2 rounded-xl p-1 size-fit border-red-500':modelValue>0}">
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
                <div class="">{{ orderItem.sale_price.toLocaleString('en-US') }}</div>
            </div>
            <div class="">
                <div class="">موجودی:</div>
                <div class="">{{ orderItem.quantity.toLocaleString('en-US') }}</div>
            </div>
            <div class="">
                <div class="">تعداد:</div>
                <div class="border rounded-xl flex overflow-hidden gap-3 items-center">
                    <div @click.stop="quantityUpdate('plus')" class="cursor-pointer bg-red-500/50 px-2">+</div>
                    <div class="">{{ orderItem.order_quantity }}</div>
                    <div @click.stop="quantityUpdate('minus')" class="cursor-pointer bg-green-500/50 px-2">-</div>
                </div>
            </div>
        </div>
    </div>
</template>
