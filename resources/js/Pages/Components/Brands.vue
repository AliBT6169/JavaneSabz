<script setup>
import {onMounted} from "vue";

const props = defineProps(["brandsData"]);
onMounted(() => {
    console.log(props.brandsData);
});
</script>

<template>
    <div class="w-[80rem] mx-auto overflow-x-scroll">
        <div class="flex w-fit text-xs gap-4 mt-4 py-5">
            <div class="brand-list" v-for="item in props.brandsData">
                <img :src="item" alt="" class="brands-image"
                     @dragstart.prevent>
            </div>
        </div>
    </div>
</template>
