<script setup>
const props = defineProps(["labelText","multiLine"]);


</script>

<template>
    <div class="w-full h-fit text-sm justify-between items-center text-nowrap flex gap-2
     text-white dark:text-black">
        <label class="w-full" for="name">{{ props.labelText }}</label>
        <input id="name" type="text"
               class="text-sm rounded-xl w-full bg-slate-200 dark:bg-gray-700
                text-slate-800 dark:text-white"
               v-if="!props.multiLine">
        <textarea v-if="props.multiLine" class="text-sm rounded-xl w-full bg-slate-200 dark:bg-gray-700
                text-slate-800 dark:text-white" cols="30" rows="5"></textarea>
    </div>
</template>
