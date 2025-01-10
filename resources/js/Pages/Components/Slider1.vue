<script setup>
import {onMounted, ref} from "vue";
import SvgComponent from "@/Components/svg-component.vue";

const props = defineProps(["slider1Data"]);
const X = ref(0);
const slide = ref(0);
const translation = ref(0);
const drag = ref(false);
const interval = ref(5000);
const sliderWith = ref();
onMounted(() => {
    sliderWith.value = document.getElementById('bt_slider_parent').clientWidth / 16;
})
const slider_show = (movement = "no") => {
    if (movement === "forward") {
        slide.value < props.slider1Data.length - 1 ? slide.value++ : slide.value = 0;
    } else if (movement === "backward") {
        slide.value > 0 ? slide.value-- : slide.value = props.slider1Data.length - 1;
    }
    translation.value = slide.value * sliderWith.value;
}
document.addEventListener('mouseup', function (event) {
    drag.value = false;
    if (!(event.target.classList.contains("slider1"))) {
        mouse_upd(event);
        document.getElementById('slider').style.transform = "translateX(" + slide.value * sliderWith.value + "rem)";
    }

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
        if (trans > -3 && trans * 16 + sliderWith.value * 16 - 100 < slider.clientWidth) {
            slider.style.transform = "translateX(" + trans + "rem)";
        }
    }
}

const mouse_upd = (event) => {
    document.getElementById("slider").style.transitionProperty = "all";
    let slider_direction = "";
    if (drag.value) {
        if (X.value + sliderWith.value * 16 / 10 < event.pageX)
            slider_show("forward");
        else if (event.pageX + sliderWith.value * 16 / 10 < X.value)
            slider_show("backward");
        document.getElementById('slider').style.transform = "translateX(" + slide.value * sliderWith.value + "rem)";
        timer.value = setInterval(slider_show, interval.value, 'forward');
        drag.value = false;
    }
}
const timer = ref(setInterval(slider_show, interval.value, 'forward'));

</script>

<template>
    <div id="bt_slider_parent"
         class="slider1 mx-auto relative mt-1 rounded-2xl w-[20rem] h-40 overflow-hidden cursor-pointer
          sm:w-[30rem] sm:h-48 md:w-[40rem] md:h-52 lg:w-[60rem] lg:h-80 xl:w-[80rem] xl:h-96">
        <div id="slider" class="flex w-fit h-96 duration-500" @mouseup="mouse_upd"
             @mousemove="mouse_moved" @mousedown="mouse_downed" @touchstart="mouse_downed" @touchmove="mouse_moved"
             @touchend="mouse_upd"
             :style="`transform: translateX(${translation}rem)`">
            <span class="slider-pages" v-for="item in props.slider1Data">
                <img class="slider1 size-full select-none" :src="item" alt=""
                     @dragstart.prevent>
            </span>
        </div>
        <!--        slider controllers-->
        <div class="slider1 flex justify-between items-center w-full px-4 absolute top-16
             sm:top-20 md:top-24 lg:top-32 xl:top-40" @mousemove="mouse_moved"
             @mouseup="mouse_upd"
             @mousemove.prevent @mousedown="mouse_downed">
            <div class="slider-button" @click="slider_show('backward')">
                <svg-component name="chev-right" class="size-4 sm:size-5 lg:size-8 xl:size-10"></svg-component>
            </div>
            <div class="slider-button" @click="slider_show('forward')">
                <svg-component name="chev-left" class="size-4 sm:size-5 lg:size-8 xl:size-10"></svg-component>
            </div>
        </div>
    </div>
</template>
