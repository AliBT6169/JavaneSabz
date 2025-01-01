<script setup>
import {onMounted, ref} from "vue";

const props = defineProps(["brandsData"]);
const dragging = ref(false);
const slider = ref();
const startX = ref();
document.addEventListener("mouseup", function (e) {
    dragging.value = false;
});
onMounted(() => {
    slider.value = document.querySelector("#brands");
});
const mousedowned = (e) => {
    dragging.value = true;
    startX.value = e.pageX;
}
const mousmoving = (e) => {
    if (dragging.value) {
        slider.value.scrollLeft += (startX.value - e.pageX) / 20;
    }
}
const mouseupd = (e) => {
    dragging.value = false;
}
</script>

<template>
    <div id="brands" class="w-[80rem] mx-auto overflow-x-scroll" @mousedown="mousedowned" @mousemove="mousmoving"
         @mouseup="mouseupd">
        <div class="flex w-fit text-xs gap-4 mt-4 py-5">
            <div class="brand-list" v-for="item in props.brandsData">
                <img :src="item" alt="" class="brands-image"
                     @dragstart.prevent>
            </div>
        </div>
    </div>
</template>
