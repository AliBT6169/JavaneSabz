<script setup>

import Product from "@/Pages/Components/Product.vue";
import {onMounted, ref} from "vue";

const productData = ref("../../../../images/products/Emamectin.jpg");
const dragging = ref(false);
const slider = ref();
const startX = ref();
document.addEventListener("mouseup", function (e) {
    dragging.value = false;
});
onMounted(() => {
    slider.value = document.querySelector("#product-slider");
});
const mousedowned = (e) => {
    dragging.value = true;
    startX.value = e.pageX;
}
const mousmoving = (e) => {
    if (dragging.value) {
        slider.value.style.cursor = "grab";
        slider.value.scrollLeft += (startX.value - e.pageX) / 2;
        startX.value = e.pageX;
    } else
        slider.value.style.cursor = "pointer";
}
const mouseupd = (e) => {
    dragging.value = false;
}
</script>

<template>
    <div id="product-slider" class="overflow-scroll py-4 mx-auto select-none" @mousedown="mousedowned"
         @mousemove="mousmoving"
         @mouseup="mouseupd">
        <div class=" text-nowrap w-fit gap-2 flex">
            <Product :image="productData" name="امامکتین بنزوات" v-for="item in 10"></Product>
        </div>
    </div>

</template>
