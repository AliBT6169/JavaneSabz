<script setup>
import IndexLyout from "@/Pages/IndexLyout.vue";

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});
console.log(props.data);
</script>

<template>
    <IndexLyout>
        محصولات
    </IndexLyout>
</template>
