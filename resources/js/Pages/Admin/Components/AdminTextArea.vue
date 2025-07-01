<script setup>
const props = defineProps({
    modelValue: null,
    label: {
        default: 'توضیحات :'
    }
});
const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="space-y-4">
        <div class="">{{label}}</div>
        <textarea class="admin_inputs" :placeholder="label"
                  @input="(e)=>emit('update:modelValue',e.target.value)">{{props.modelValue}}</textarea>
    </div>
</template>
