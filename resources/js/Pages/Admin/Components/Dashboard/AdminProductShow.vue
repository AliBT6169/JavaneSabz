<script setup>
import {useToast} from "vue-toastification";

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
});

const changeQuantity = async (e) => {
    if (e === '+') {
        await axios.get(route('admin.productVariation.Increment', props.product.id)).then(res => {
            props.product.quantity++;
        });
    } else {
        await axios.get(route('admin.productVariation.Decrement', props.product.id)).then(res => {
            props.product.quantity--;
        }).catch(err => {
            useToast().error(err.response.data.message);
        });
    }
}
</script>

<template>
    <div class="border-2 border-adminColor2 rounded-xl space-y-2 w-40 md:w-60">
        <img :src="typeof product.images === 'string'?product.images:product.images[0].image" alt=""
             class="size-40 md:size-60 rounded-xl">
        <div class="space-y-2 p-2 *:flex *:justify-between *:items-center *:border-b border-b-adminColor4">
            <div class="">
                <div class="">تعداد فروش:</div>
                <div class="">{{ product.sailed_quantity.toLocaleString('en-US') }}</div>
            </div>
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
                <div class="">{{ product.weight }}</div>
            </div>
            <div class="">
                <div class="">قیمت:</div>
                <div class="">{{ product.sale_price.toLocaleString('en-US') }}</div>
            </div>
            <div class="text-center">
                <div class="">موجودی:</div>
                <div class="space-y-0.5">
                    <div class="">{{ product.quantity.toLocaleString('en-US') }}</div>
                    <div
                        class="flex rounded-xl overflow-hidden text-lg select-none *:px-2 *:cursor-pointer *:duration-300 hover:*:scale-90">
                        <div @click="changeQuantity('+')" class="bg-green-500/70">+</div>
                        <div @click="changeQuantity('-')" class="bg-red-500/70">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
