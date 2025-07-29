<script setup>
const props = defineProps({
    product: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="border-2 border-adminColor2 rounded-xl space-y-2 w-40 md:w-60">
        <img :src="typeof product.images === 'string'?product.images:product.images[0].image" alt="" class="size-40 md:size-60 rounded-xl">
        <div class="space-y-2 px-2 *:flex *:justify-between *:items-center *:border-b border-b-adminColor4">
            <div class="">
                <div class="">تعداد فروش: </div>
                <div class="">{{ product.sailed_quantity.toLocaleString('en-US') }}</div>
            </div>
            <div class="">
                <div class="">نام: </div>
                <div class="">{{ product.name }}</div>
            </div>
            <div class="">
                <div class="">اندازه: </div>
                <div class="">{{ product.value }}</div>
            </div>
            <div class="">
                <div class="">وزن: </div>
                <div class="">{{ product.weight }}</div>
            </div>
            <div class="">
                <div class="">قیمت: </div>
                <div class="">{{ product.sale_price.toLocaleString('en-US') }}</div>
            </div>
            <div class="">
                <div class="">تعداد: </div>
                <div class="">{{ product.quantity .toLocaleString('en-US')}}</div>
            </div>
        </div>
    </div>
</template>
