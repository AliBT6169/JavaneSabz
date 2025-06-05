<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";

const props = defineProps({
    component_index: null
})
const emit = defineEmits({
    dataSend: null,
});
const VariationImages = ref('');

const variationData = ref({
    'value': '',
    'weight': 1,
    'price': 1000,
    'quantity': 1000,
    'off_sale': 0,
});
const modal = ref('');
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
        console.log('closed')
    }
}

onMounted(() => {
    document.addEventListener('click', modalCloser);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
</script>

<template>
    <div class="size-40 flex justify-center bg-adminColor2 duration-500 overflow-hidden rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 size-5/6 py-6':modal_status}"
         @click="modal_status = true">
        <form :class="{'hidden':!modal_status}" class="w-full">
            <label :for="'variation-image' + component_index" class="relative cursor-pointer m-auto duration-300 size-40 rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
                <input type="file" :id="'variation-image' + component_index" accept="*image/*"
                       class="invisible absolute"
                       @change="onFileChange">
                <img
                    :src="VariationImages[0] === undefined?'/images/default/product.png':VariationImages[0]"
                    class="size-full"
                    alt="">
            </label>
            <div class="p-2 space-y-5 *:space-y-5 md:space-y-0 md:*:space-y-0 md:*:flex *:gap-5 *:justify-center *:w-full ">
                <div class="">
                    <admin-input name="اندازه"/>
                    <admin-input name="وزن"/>
                </div>
                <div class="">
                    <admin-input name="تعداد"/>
                    <admin-input name="تخفیف"/>
                </div>
            </div>
        </form>
        <div @click.stop="modal_status = true" class=" cursor-pointer m-auto duration-300 size-full rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden"
             :class="{'hidden':modal_status}">
            <img :src="VariationImages[0] === undefined?'/images/default/product.png':VariationImages[0]"
                 class="size-full"
                 alt="">
        </div>
    </div>
</template>
