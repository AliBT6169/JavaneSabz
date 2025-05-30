<script setup>
const props = defineProps({
    message: ''
});
</script>

<template>
    <div class="flex items-center justify-between gap-5">
        <div class="">{{message}}</div>
        <div class="bg-green-300 rounded-xl py-1 px-2 border cursor-pointer" @click="$emit('set')">بله</div>
    </div>
</template>
