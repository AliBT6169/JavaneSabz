<script setup>

import IndexLyout from "@/Pages/IndexLyout.vue";
import BlogItem from "@/Pages/Components/Home/BlogItem.vue";

const props = defineProps({
    blogs: Array,
});
</script>

<template>
    <IndexLyout>
        <div class="space-y-5 md:flex md:space-y-0 md:flex-wrap md:gap-5 md:justify-center md:items-center">
            <BlogItem v-for="item in blogs.data" :blog="item"/>
        </div>
    </IndexLyout>
</template>
