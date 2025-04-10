<script setup>
const props = defineProps()
</script>

<template>
    <select name="city" id="city" class="">
        <option selected value="">شهر</option>
        <option v-for="item in 5" value="">شهر</option>
    </select>
    <select name="city" id="city" class="">
        <option selected value="">استان</option>
        <option v-for="item in 5" value="">استان</option>
    </select>
</template>
