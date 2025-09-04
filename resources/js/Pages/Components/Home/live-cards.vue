<script setup>
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    banner: {
        type: Object,
        required: true
    }
});
const pointer_X = ref(0);
const pointer_Y = ref(0);
const mouse_Moving = (e) => {
    pointer_X.value = (e.offsetX - e.target.width / 2) / 40;
    pointer_Y.value = (e.offsetY - e.target.height / 2) / 20;
}
const mouse_Leaving = () => {
    pointer_X.value = 0;
    pointer_Y.value = 0;
}
</script>

<template>
    <Link :href="route('attributes.sendToShow',{id:banner.id,slug:banner.slug})" class="flex size-full justify-center duration-100 relative items-center cursor-pointer rounded-xl overflow-hidden"
         @mousemove="mouse_Moving" @mouseleave="mouse_Leaving"
         :style="`transform: perspective(1000px) rotateY(${pointer_X}deg) rotateX(${pointer_Y}deg)`">
        <img class="size-full" :src="banner.icon" :alt="banner.title">
        <div class="bg-gray-50/80 absolute p-2 rounded-xl w-60 text-center bottom-10 dark:bg-gray-900/80">{{banner.title}}</div>
    </Link>
</template>
