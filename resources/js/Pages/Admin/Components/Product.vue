<script setup>
const props = defineProps({
    product: null,
})
</script>

<template>
    <div class="pb-2 w-60 rounded-xl overflow-hidden border border-current space-y-4">
        <img :src="product.image" class="w-full max-h-40 border" alt="">
        <div
            class="px-2 text-nowrap space-y-2 *:flex *:justify-between *:products-center *:gap-4 *:border-t *:border-current *:rounded-t-xl">
            <div class="">
                <div class="">برند:</div>
                <div class="">{{ product.brand }}</div>
            </div>
            <div class="">
                <div class="">دسته بندی:</div>
                <div class="">{{ product.category }}</div>
            </div>
            <div class="">
                <div class="">نام محصول:</div>
                <div class="">{{ product.name }}</div>
            </div>
            <div class="!justify-start !gap-2 products-center flex-wrap">
                <div v-for="variation in product.variations" class="">{{ variation.name }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
