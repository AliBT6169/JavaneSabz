<script setup>
import {reactive, ref} from "vue";

const props = defineProps(["imageURL", "title"]);
const pointer_X = ref(0);
const pointer_Y = ref(0);
const mouse_Moving = (e) => {
    pointer_X.value = (e.offsetX - e.target.width / 2)/40;
    pointer_Y.value = (e.offsetY - e.target.height / 2)/20;
}
const mouse_Leaving = () => {
  pointer_X.value = 0;
  pointer_Y.value = 0;
}
</script>

<template>
    <div class="flex size-full justify-center duration-100 items-center cursor-pointer rounded-xl overflow-hidden" @mousemove="mouse_Moving" @mouseleave="mouse_Leaving"
    :style="`transform: perspective(1000px) rotateY(${pointer_X}deg) rotateX(${pointer_Y}deg)`">
        <img class="size-full" :src="props.imageURL" :alt="props.title">
    </div>
</template>
