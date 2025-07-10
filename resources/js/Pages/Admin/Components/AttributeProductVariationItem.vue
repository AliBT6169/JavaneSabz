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
            <img :src="typeof product.images==='string'?product.images:product.images[0].image" alt=""
                 class="size-full">
        </div>
        <div class="space-y-4 px-1 pb-2 *:flex *:justify-between *:items-center">
            <div class="">
                <div class="">نام:</div>
                <div class="">{{ product.name }}</div>
            </div>
            <div class="">
                <div class="">اندازه:</div>
                <div class="">{{ product.value }}</div>
            </div>
            <div class="">
                <div class="">وزن:</div>
                <div class="">{{ product.weight }}KG</div>
            </div>
            <div class="">
                <div class="">تعداد:</div>
                <div class="">{{ product.quantity }}</div>
            </div>
            <div class="">
                <div class="">تخفیف:</div>
                <div class="">{{ product.off_sale }}%</div>
            </div>
            <div class="">
                <div class="">قیمت:</div>
                <div class="">{{ product.sale_price }}</div>
            </div>
        </div>
    </div>
</template>
