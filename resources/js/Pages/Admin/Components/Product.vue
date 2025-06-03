<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";

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
                <div class="">نام محصول:</div>
                <div class="">{{ product.name }}</div>
            </div>
            <div class="p-1 *:px-1 *:border *:cursor-pointer *:duration-300 *:rounded-3xl *:shadow-md *:shadow-gray-500 hover:*:scale-95">
                <div
                    class="bg-adminColor2">
                    تغییر اطلاعات
                    <svg-component name="edit" class="size-5 inline"/>
                </div>
                <div class="bg-green-500" :class="{'!bg-red-500':product.is_active===0}">{{ product.is_active?'فعال':'غیر فعال' }}</div>
            </div>
            <div class="">
                <div class="">برند:</div>
                <div class="">{{ product.brand }}</div>
            </div>
            <div class="">
                <div class="">دسته بندی:</div>
                <div class="">{{ product.category }}</div>
            </div>
            <div class="!justify-start !gap-2 products-center flex-wrap pt-1">
                <div class="">سایز:</div>
                <div v-for="(variation, index) in product.variations"
                     :class="{'border-l pl-2 border-current':product.variations.length-1> index}">
                    {{ variation.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
