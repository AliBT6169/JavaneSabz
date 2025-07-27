<script setup>
import {onMounted} from "vue";

const props = defineProps({
    modelValue: null
});
const emit = defineEmits({
    'update:modelValue': null
});
onMounted(() => {
    document.addEventListener('click', ()=>{

    });
})
</script>

<template>
    <div class="absolute invisible top-[50rem] opacity-0" :class="{'visible opacity-100 top-10':modelValue}"></div>
</template>
