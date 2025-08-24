<script setup>

import IndexLyout from "@/Pages/IndexLyout.vue";
import BlogItem from "@/Pages/Components/Home/BlogItem.vue";

const props = defineProps({
    blogs: Array,
});
console.log(props.blogs.data)
</script>

<template>
    <IndexLyout>
        <div class=""></div>
        <BlogItem v-for="item in blogs.data" :blog="item"/>
    </IndexLyout>
</template>
