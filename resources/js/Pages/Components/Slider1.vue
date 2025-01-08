<script setup>
import {onMounted, ref} from "vue";
import SvgComponent from "@/Components/svg-component.vue";

const props = defineProps(["slider1Data"]);
const X = ref(0);
const slide = ref(0);
const translation = ref(0);
const drag = ref(false);
const interval = ref(5000);
const slider_show = (movement = "no") => {
    if (movement === "forward") {
        slide.value < props.slider1Data.length - 1 ? slide.value++ : slide.value = 0;
    } else if (movement === "backward") {
        slide.value > 0 ? slide.value-- : slide.value = props.slider1Data.length - 1;
    }
    translation.value = slide.value * 80;
}
document.addEventListener('mouseup', function (event) {
    drag.value = false;
    if (!(event.target.classList.contains("slider1")))
        mouse_upd(event);
});
const mouse_downed = (event) => {
    X.value = event.pageX;
    drag.value = true;
    document.getElementById("slider").style.transitionProperty = "none";
    clearInterval(timer.value);
}
const mouse_moved = (event) => {
    if (drag.value) {
        let slider = document.getElementById("slider");
        let trans = translation.value + (event.pageX - X.value) / 16;
        if (trans > -10 && trans * 16 + 1100 < slider.clientWidth) {
            slider.style.transform = "translateX(" + trans + "rem)";
        }
    }
}

const mouse_upd = (event) => {
    document.getElementById("slider").style.transitionProperty = "all";
    drag.value = false;
    let slider_direction = "";
    if (X.value + 200 < event.pageX)
        slider_show("forward");
    else if (event.pageX + 200 < X.value)
        slider_show("backward");
    document.getElementById('slider').style.transform = "translateX(" + slide.value * 80 + "rem)";
    timer.value = setInterval(slider_show, interval.value, 'forward');
}
const timer = ref(setInterval(slider_show, interval.value, 'forward'));
</script>

<template>
    <div class="slider1 mx-auto relative mt-1 rounded-2xl w-[80rem] overflow-hidden cursor-pointer">
        <div id="slider" class=" flex w-fit h-96 duration-500" @mouseup="mouse_upd"
             @mousemove="mouse_moved" @mousedown="mouse_downed"
             :style="`transform: translateX(${translation}rem)`">
            <span class="slider-pages" v-for="item in props.slider1Data">
                <img class="slider1 size-full select-none" :src="item" alt=""
                     @dragstart.prevent>
            </span>
        </div>
        <!--        slider controllers-->
        <div class="slider1 flex justify-between items-center w-full px-10 absolute top-40" @mousemove="mouse_moved"
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
