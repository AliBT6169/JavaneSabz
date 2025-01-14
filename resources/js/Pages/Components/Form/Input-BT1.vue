<script setup>

const props = defineProps(["labelText"]);
</script>

<template>
    <div class="w-full h-fit justify-between items-center text-nowrap flex gap-2 dark:text-black">
        <label for="name">{{ props.labelText }}</label>
        <input id="name" type="text"
               class="text-sm rounded-xl text-black bg-slate-200 dark:bg-gray-700 dark:text-white">
    </div>
</template>
