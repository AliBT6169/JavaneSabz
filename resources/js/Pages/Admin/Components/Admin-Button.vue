<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    text: '',
    type: '',
    disabled: false,
});
</script>

<template>
    <button :type="type" class="px-12 w-full py-2 rounded-xl duration-300 cursor-pointer border-2 bg-adminColor1 border-adminColor2
     dark:bg-adminColor3 dark:border-adminColor4 hover:scale-95 hover:shadow-inner hover:shadow-gray-500 md:w-fit disabled:text-gray-500 disabled:hover:shadow-none disabled:hover:scale-100"
            :class="{'bg-red-300 border-red-600 dark:bg-red-400 dark:border-red-800':type==='cancel'}"
            :disabled="disabled">{{ text }}
        <SvgComponent name="spinner" class="size-4 inline animate-spin" v-if="disabled"/>
    </button>
</template>

