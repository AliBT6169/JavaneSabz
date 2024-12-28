<script setup>
import {ref} from "vue";
import SvgComponent from "@/Components/svg-component.vue";

const X = ref(0);
const slide = ref(0);
const translation = ref(0);
const slider_show = (movement) => {
    if (movement === "forward") {
        slide.value < 2 ? slide.value++ : slide.value = 0;
    } else {
        slide.value > 0 ? slide.value-- : slide.value = 2;
    }
    translation.value = slide.value * 80;
}
const mouse_downed = (event) => {
    X.value = event.clientX;
}
const mouse_moved = (event) => {
    if (X.value > event.clientX)
        translation.value -= X.value - event.clientX;
    else
        translation.value += event.clientX - X.value;
}
// setInterval(slider_show, 5000)
</script>

<template class="w-full">
    <div class="mx-auto relative mt-1 rounded-2xl w-[80rem] overflow-hidden">
        <div class=" flex w-fit h-96 transition-all duration-500" @mousedown="mouse_downed"
             :class="`translate-x-[${translation}rem]`">
            <span class="slider-pages">
                <img class="size-full" src="../../../../public/images/slider/strawberry-farm.jpg" alt="">
            </span>
            <span class="slider-pages">
                <img class="size-full" src="../../../../public/images/slider/fertilizer-in-farm.jpg" alt="">
            </span>
            <span class="slider-pages">
                <img class="size-full" src="../../../../public/images/slider/pesticide-1.webp" alt="">
            </span>
        </div>
        <div class="flex justify-between items-center w-full px-10 absolute top-40">
            <div class="slider-button" @click="slider_show('backward')">
                <svg-component name="chev-right" class="size-6"></svg-component>
            </div>
            <div class="slider-button" @click="slider_show('forward')">
                <svg-component name="chev-left" class="size-6"></svg-component>
            </div>
        </div>
    </div>
</template>
