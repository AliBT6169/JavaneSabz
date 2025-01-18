<script setup>
const props = defineProps(["Label"]);

const model = defineModel({
    type: String,
    required: true,
});
</script>

<template>
    <input type="text" v-model="model" class="w-full border-0 border-b-2 bg-transparent focus:border-defaultColor focus:outline-0 focus:ring-0
     border-slate-500" :placeholder="props.Label">
</template>
