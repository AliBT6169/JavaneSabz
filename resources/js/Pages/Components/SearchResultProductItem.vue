<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import ProductShowModal from "@/Pages/Components/Home/ProductShowModal.vue";

const props = defineProps({
    Product: {
        type: Object,
        required: true,
    }
});

const productModal = ref(false);
const productModalData = ref();
const productShow = async () => {
    const data = ref(await useIndexStore().productShow(props.Product.id));
    if (data.value.status === 200) {
        productModal.value = true;
        productModalData.value = data.value.data
    }
}
</script>

<template>
    <div
        class="space-y-2 p-2 text-xs w-32 rounded-2xl border-2 border-defaultColor *:m-auto md:w-44 md:text-base dark:border-defaultColor5">
        <Link class="size-16 block" :href="route('ProductShow',{id:Product.id,slug:Product.slug})">
            <img :src="Product.image" alt=""
                 class="rounded-full size-full border-4 border-defaultColor dark:border-defaultColor5">
        </Link>
        <div class="flex gap-2 justify-center">
            <h3 class="">{{ Product.name }}</h3>
            :
            <h3 class="">{{ Product.value }}</h3>
        </div>
        <div
            class="space-y-2 *:w-full *:border-2 *:p-2 *:rounded-full *:border-defaultColor dark:*:border-defaultColor5">
            <div class="shine_animation group relative overflow-hidden">
                <div
                    class="flex items-center duration-300 text-nowrap -translate-x-12 group-hover:translate-x-6 md:translate-x-[-4.7rem] md:group-hover:translate-x-8">
                    <div class="">سبد خرید</div>
                    <svg-component name="cart" class="size-6 mx-10 md:mx-16"/>
                </div>
            </div>
            <div @click="productShow" class="shine_animation group relative overflow-hidden">
                <div
                    class="flex items-center duration-300 text-nowrap -translate-x-12 group-hover:translate-x-6 md:translate-x-[-4.7rem] md:group-hover:translate-x-8">
                    <div class="">مشاهده</div>
                    <svg-component name="show" class="size-6 mx-10 md:mx-16"/>
                </div>
            </div>
        </div>
    </div>
    <div
        class="fixed invisible z-50 opacity-0 duration-500 top-0 left-0 flex justify-center items-center w-screen h-screen bg-gray-800/30"
        :class="{'!visible !opacity-100':productModal}"
        @click.self="productModal = false">
        <product-show-modal v-if="productModal" :product-data="productModalData"/>
    </div>
</template>
