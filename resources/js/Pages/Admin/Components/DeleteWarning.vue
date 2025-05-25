<script setup>
const props = defineProps({
    message: ''
});
</script>

<template>
    <div class="flex items-center justify-between">
        <div class="">{{message}}</div>
        <div class="bg-green-300 rounded-xl py-2 px-4 border cursor-pointer" @click="$emit('set')">بله</div>
    </div>
</template>
