<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(["slider1Data"]);
const X = ref(0);
const slide = ref(0);
const translation = ref(0);
const drag = ref(false);
const interval = ref(5000);
const sliderWith = ref();
const sliderParent = ref(null);
const slider = ref(null);
onMounted(() => {
    sliderWith.value = sliderParent.value.clientWidth / 16;
    document.addEventListener('mouseup', windowMouseUp);
});
const slider_show = (movement = "no") => {
    if (movement === "forward") {
        slide.value < props.slider1Data.length - 1 ? slide.value++ : slide.value = 0;
    } else if (movement === "backward") {
        slide.value > 0 ? slide.value-- : slide.value = props.slider1Data.length - 1;
    }
    translation.value = slide.value * sliderWith.value;
}

const windowMouseUp = (event) => {
    drag.value = false;
    if (!(event.target.classList.contains("slider1"))) {
        upd(event);
        slider.value.style.transform = "translateX(" + slide.value * sliderWith.value + "rem)";
    }
}

onBeforeUnmount(() => {
    document.removeEventListener("mouseup", windowMouseUp);
});
const downed = (event) => {
    if (event.changedTouches === undefined)
        X.value = event.pageX;
    else
        X.value = event.changedTouches[0].pageX;
    drag.value = true;
    slider.value.style.transitionProperty = "none";
    clearInterval(timer.value);
}
const moved = (event) => {
    if (drag.value) {
        let trans = 0;
        if (event.changedTouches === undefined)
            trans = translation.value + (event.pageX - X.value) / 16;
        else
            trans = translation.value + (event.changedTouches[0].pageX - X.value) / 16;
        if (trans > -3 && trans * 16 + sliderWith.value * 16 - 100 < slider.value.clientWidth) {
            slider.value.style.transform = "translateX(" + trans + "rem)";
        }
    }
}

const upd = (event) => {
    const pageX = event.changedTouches !== undefined ? event.changedTouches[0].pageX : event.pageX;
    if (slider.value)
        slider.value.style.transitionProperty = "all";
    if (drag.value) {
        if (X.value + sliderWith.value * 16 / 10 < pageX)
            slider_show("forward");
        else if (pageX + sliderWith.value * 16 / 10 < X.value)
            slider_show("backward");
        slider.value.style.transform = "translateX(" + slide.value * sliderWith.value + "rem)";
        timer.value = setInterval(slider_show, interval.value, 'forward');
        drag.value = false;
    }
}
const timer = ref(setInterval(slider_show, interval.value, 'forward'));
</script>

<template>
    <div ref="sliderParent"
         class="slider1 mx-auto relative flex justify-center items-center mt-1 rounded-2xl w-[20rem] h-40 overflow-hidden cursor-pointer
          sm:w-[30rem] sm:h-48 md:w-[40rem] md:h-52 lg:w-[60rem] lg:h-80 xl:w-[80rem] xl:h-96">
        <div ref="slider" class="flex absolute top-0 right-0 w-fit h-96 duration-500" @mouseup="upd"
             @mousemove="moved" @mousedown="downed" @touchmove="moved" @touchend="upd"
             @touchstart="downed"
             :style="`transform: translateX(${translation}rem)`">
            <Link :href="route('attributes.sendToShow',{id:item.id,slug:item.slug})"
                  class="slider-pages flex relative justify-center items-center" v-for="item in props.slider1Data">
                <img loading="lazy" class="slider1 size-full select-none" :src="item.image" alt=""
                     @dragstart.prevent>
                <!--        slider text-->
                <p class="select-none  w-2/3 bottom-2 text-center text-sm text-black absolute border-2 rounded-2xl
                 bg-gray-50/50 text-current dark:bg-gray-800/50 md:p-3 lg:bottom-16"
                >{{ item.description }}</p>
            </Link>
        </div>
        <!--        slider controllers-->

        <div class="select-none slider1 flex justify-between items-center w-full px-4 absolute top-16
             sm:top-20 md:top-24 lg:top-32 xl:top-40" @mousemove="moved" @mouseup="upd" @touchmove="moved"
             @touchend="upd"
             @touchstart="downed" @mousemove.prevent @mousedown="downed">
            <div class="slider-button" @click="slider_show('backward')">
                <svg-component name="chev-right" class="size-6 lg:size-8 xl:size-10"/>
            </div>
            <div class="slider-button" @click="slider_show('forward')">
                <svg-component name="chev-left" class="size-6 lg:size-8 xl:size-10"/>
            </div>
        </div>
    </div>
</template>
