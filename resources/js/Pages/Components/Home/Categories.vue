<script setup>
import {onMounted, ref} from "vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(["categoriesData"]);
const dragging = ref(false);
const slider = ref();
const startX = ref();
document.addEventListener("mouseup", function (e) {
    dragging.value = false;
});
onMounted(() => {
    slider.value = document.querySelector("#categories");
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
    <div id="categories" class="mx-auto overflow-x-scroll" @mousedown="mousedowned" @mousemove="mousmoving"
         @mouseup="mouseupd">
        <div class="flex w-fit text-xs gap-4 mt-4 py-5">
            <Link :href="route('categories.products.show',{id:item.id,slug:item.slug})" class="brand-list" v-for="item in categoriesData">
                <img :src="item.icon" alt="" class="brands-image"
                     @dragstart.prevent>
                <h3 class="text-sm p-1 bg-gray-600/30 absolute"></h3>
            </Link>
        </div>
    </div>
</template>
