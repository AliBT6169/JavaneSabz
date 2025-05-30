<script setup>
const props = defineProps({
    text: '',
    type: ''
});
const emit = defineEmits({
    clicked: null
});
</script>

<template>
    <div @click="emit('clicked',true)" class="px-8 py-2 rounded-xl duration-300 cursor-pointer border-2 bg-adminColor1 border-adminColor2
     dark:bg-adminColor3 dark:border-adminColor4 hover:scale-95 hover:shadow-inner hover:shadow-gray-500"
         :class="{'bg-red-300 border-red-600 dark:bg-red-400 dark:border-red-800':type==='cancel'}">{{ text }}
    </div>
</template>

