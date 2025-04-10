<script setup>
const props = defineProps(["label","values"])
</script>

<template>
    <select name="city" id="city" class="">
        <option selected value="">{{ props.label }}</option>
        <option v-for="item in 5" value="">شهر ها</option>
    </select>
</template>
