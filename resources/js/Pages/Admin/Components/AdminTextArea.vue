<script setup>
const props = defineProps({
    modelValue: null,
});
const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <textarea class="admin_inputs"
              @input="(e)=>emit('update:modelValue',e.target.value)">{{props.modelValue}}</textarea>
</template>
