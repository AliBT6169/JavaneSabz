<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";
import CategoryItem from "@/Pages/Admin/Components/CategoryItem.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";
import product from "@/Pages/Components/Home/Product.vue";
import Product from "@/Pages/Admin/Components/Product.vue";
import AttributeProductItem from "@/Pages/Admin/Components/AttributeProductItem.vue";

const props = defineProps({
    modelName: {
        required: true,
    },
    modelValue: {
        required: true
    },
    modelHref: {
        required: true
    }
});
const emit = defineEmits(["update:modelValue"]);
const modal = ref();
const modal_status = ref(false);
const data = ref();
onMounted(async () => {
    axios.get(route(props.modelHref)).then(res => {
        data.value = res.data;
    }).catch(err => {
        console.log(err.data);
    });
});
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
onMounted(() => {
    document.addEventListener('click', modalCloser);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
</script>

<template>
    <div
        class="size-40 flex !justify-center bg-adminColor2 duration-500 transition-all overflow-hidden rounded-xl border"
        ref="modal"
        :class="{'fixed z-50 top-20 size-5/6 py-6 overflow-scroll !bg-adminColor1':modal_status}">
        <div v-if="!modal_status" @click.stop="modal_status=true" ref="modal"
             class="size-40 rounded-xl border-2 border-current flex justify-center items-center">{{
                modelName
            }}
        </div>
        <div v-else class="">
            <div v-if="modelHref.includes('categories')" class="size-full *:!w-full space-y-6 items-center ">
                <category-item v-for="item in data" :category-data="item"/>
            </div>
            <div v-if="modelHref.includes('brands')"
                 class="size-full flex flex-wrap justify-center gap-6 *:!w-40 items-center ">
                <brand-item v-for="item in data" :brand-data="item"/>
            </div>
            <div v-if="modelHref.includes('products')"
                 class="size-full flex flex-wrap justify-center gap-6 *:!w-60 items-center ">
                <Product v-for="item in data" :product="item"/>
            </div>
            <div v-if="modelHref.includes('productVariations')"
                 class="size-full flex flex-wrap justify-center gap-6 *:!w-40 items-center ">
                <AttributeProductItem v-for="item in data" :product="item"/>
            </div>
        </div>
    </div>
</template>
