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
document.addEventListener('mouseup', function () {
    drag.value = false;
});
const mouse_downed = (event) => {
    X.value = event.pageX;
    drag.value = true;
    document.getElementById("slider").style.transitionProperty = "none";
}
const mouse_moved = (event) => {
    if (drag.value) {
        let slider = document.getElementById("slider");
        let trans = translation.value + (event.pageX - X.value) / 16;
        if (trans > 0 && trans * 16 + 1400 < slider.clientWidth) {
            slider.style.transform = "translateX(" + trans + "rem)";
        }
    }
}
const mouse_upd = (event) => {
    document.getElementById("slider").style.transitionProperty = "all";
    drag.value = false;
    if (X.value + 200 < event.pageX)
        slider_show('forward');
    else if (event.pageX + 200 < X.value)
        slider_show('backward');
}
setInterval(slider_show, 3000);
</script>

<template class="w-full">
    <div class="mx-auto relative mt-1 rounded-2xl w-[80rem] overflow-hidden cursor-pointer">
        <div id="slider" class=" flex w-fit h-96 duration-500" @mouseup="mouse_upd"
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
        <div class="flex justify-between items-center w-full px-10 absolute top-40" @mousemove="mouse_moved"
             @mouseup="mouse_upd"
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
