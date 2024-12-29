<script setup>
import {onMounted, ref} from "vue";
import SvgComponent from "@/Components/svg-component.vue";

const X = ref(0);
const slide = ref(0);
const translation = ref(0);
const drag = ref(false);
const slider_show = (movement) => {
    if (movement === "forward") {
        slide.value < 2 ? slide.value++ : slide.value = 0;
    } else if (movement === "backward") {
        slide.value > 0 ? slide.value-- : slide.value = 2;
    }
    translation.value = slide.value * 80;
}
const mouse_downed = (event) => {
    console.log('اولی' + event.offsetX)
    X.value = event.offsetX;
    drag.value = true;
    // console.log(X.value)
}
const mouse_moved = (event) => {
    // if (drag.value) {
    //     translation.value +=(event.offsetX-X.value)/16 ;
    //     console.log(translation.value)
    // }
}
const mouse_upd = (event) => {
    drag.value = false;
    console.log('دومی' + event.offsetX)
    if (X.value + 200 < event.offsetX)
        slider_show('forward');
    else if (event.offsetX + 200 < X.value)
        slider_show('backward');
}
// setInterval(slider_show, 5000);
</script>

<template class="w-full">
    <div class="mx-auto relative mt-1 rounded-2xl w-[80rem] overflow-hidden">
        <div id="slider" class=" flex w-fit h-96 transition-all duration-500" @mouseup="mouse_upd"
             @mousemove="mouse_moved" @mousedown="mouse_downed"
             :style="`transform: translateX(${translation}rem)`">
            <span class="slider-pages">
                <img class="size-full select-none" src="../../../../public/images/slider/strawberry-farm.jpg" alt=""
                     @dragstart.prevent>
            </span>
            <span class="slider-pages">
                <img class="size-full select-none" src="../../../../public/images/slider/fertilizer-in-farm.jpg" alt=""
                     @dragstart.prevent>
            </span>
            <span class="slider-pages">
                <img class="size-full select-none" src="../../../../public/images/slider/pesticide-1.webp" alt=""
                     @dragstart.prevent>
            </span>
        </div>
        <!--        slider controllers-->
        <div class="flex justify-between items-center w-full px-10 absolute top-40" @mouseup="mouse_upd"
             @mousemove.prevent @mousedown="mouse_downed">
            <div class="slider-button" @click="slider_show('backward')">
                <svg-component name="chev-right" class="size-6"></svg-component>
            </div>
            <div class="slider-button" @click="slider_show('forward')">
                <svg-component name="chev-left" class="size-6"></svg-component>
            </div>
        </div>
    </div>
</template>
