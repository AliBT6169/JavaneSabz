<script setup>

import IndexLyout from "@/Pages/IndexLyout.vue";

const props = defineProps({
    blog: Object,
});

</script>

<template>
    <IndexLyout>
        <div class="space-y-5">
            <img :src="blog.data.icon" class="size-full md:size-1/2 m-auto rounded-2xl" alt="">
        </div>
    </IndexLyout>
</template>
