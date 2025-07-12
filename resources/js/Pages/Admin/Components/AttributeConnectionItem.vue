<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";
import CategoryItem from "@/Pages/Admin/Components/CategoryItem.vue";
import BrandItem from "@/Pages/Admin/Components/BrandItem.vue";
import Product from "@/Pages/Admin/Components/Product.vue";
import AttributeProductVariationItem from "@/Pages/Admin/Components/AttributeProductVariationItem.vue";
import AttributeProductItem from "@/Pages/Admin/Components/AttributeProductItem.vue";
import AttributeCategoryItem from "@/Pages/Admin/Components/AttributeCategoryItem.vue";
import AttributeBrandItem from "@/Pages/Admin/Components/AttributeBrandItem.vue";

const props = defineProps({
    modelName: {
        required: true,
    },
    modelValue: {
        required: true,
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
const updateModelValue = (id) => {
    const modelValue = ref(props.modelValue)
    if (modelValue.value.includes(id))
        modelValue.value = modelValue.value.filter((item => item !== id));
    else
        modelValue.value.push(id);
    emit('update:modelValue', modelValue.value)
}

</script>

<template>
    <div
        class="size-40 flex !justify-center bg-adminColor2 duration-500 transition-all overflow-hidden rounded-xl border dark:bg-adminColor3"
        ref="modal"
        :class="{'fixed z-50 top-20 size-5/6 py-6 overflow-scroll !bg-adminColor1 dark:!bg-adminColor3':modal_status}">
        <div v-if="!modal_status" @click.stop="modal_status=true" ref="modal"
             class="size-40 rounded-xl border-2 border-current flex justify-center items-center">{{
                modelName
            }}
        </div>
        <div v-else class="">
            <div v-if="modelHref.includes('categories')"
                 class="size-full flex flex-wrap justify-center gap-6 p-2 items-center">
                <div class="border-0 duration-300"
                     :class="{'border-2 rounded-xl p-1 border-red-500':modelValue.includes(item.id)}"
                     v-for="item in data">
                    <AttributeCategoryItem @click="updateModelValue(item.id)"
                                           :category="item"/>
                </div>
            </div>
            <div v-if="modelHref.includes('brands')"
                 class="size-full flex flex-wrap justify-center gap-6 items-center">
                <div class="border-0 duration-300"
                     :class="{'border-2 rounded-xl p-1 border-red-500':modelValue.includes(item.id)}"
                     v-for="item in data">
                    <AttributeBrandItem :brand="item"
                                        @click="updateModelValue(item.id)"/>
                </div>
            </div>
            <div v-if="modelHref.includes('products')"
                 class="size-full flex flex-wrap justify-center gap-6 items-center">
                <div class="border-0 duration-300"
                     :class="{'border-2 rounded-xl p-1 border-red-500':modelValue.includes(item.id)}"
                     v-for="item in data">
                    <AttributeProductItem :product="item"
                                          @click="updateModelValue(item.id)"/>
                </div>
            </div>
            <div v-if="modelHref.includes('productVariations')"
                 class="size-full flex flex-wrap justify-center gap-6 p-2 items-center">
                <div class="border-0 duration-300"
                     :class="{'border-2 rounded-xl p-1 border-red-500':modelValue.includes(item.id)}"
                     v-for="item in data">
                    <AttributeProductVariationItem :product="item"
                                                   @click="updateModelValue(item.id)"/>
                </div>
            </div>
        </div>
    </div>
</template>
