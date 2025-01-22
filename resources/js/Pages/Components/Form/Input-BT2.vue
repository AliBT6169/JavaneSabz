<script setup>
const props = defineProps(["Label"]);

const model = defineModel({
    type: String,
    required: true,
});
</script>

<template>
    <input type="text" v-model="model" class="w-full border-0 px-5 border-b-2 bg-transparent placeholder-defaultColor focus:outline-0 focus:ring-0
     border-defaultColor" :placeholder="props.Label">
</template>
