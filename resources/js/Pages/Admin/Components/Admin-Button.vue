<script setup>
const props = defineProps({
    text: '',
    type: ''
});
</script>

<template>
    <button :type="type" class="px-12 w-full py-2 rounded-xl duration-300 cursor-pointer border-2 bg-adminColor1 border-adminColor2
     dark:bg-adminColor3 dark:border-adminColor4 hover:scale-95 hover:shadow-inner hover:shadow-gray-500 md:w-fit"
         :class="{'bg-red-300 border-red-600 dark:bg-red-400 dark:border-red-800':type==='cancel'}">{{ text }}
    </button>
</template>

