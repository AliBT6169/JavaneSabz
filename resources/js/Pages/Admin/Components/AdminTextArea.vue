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
    <div class="">
        <div class="pr-2">{{label}}</div>
        <textarea class="admin_inputs no-scrollbar" :placeholder="label"
                  @input="(e)=>emit('update:modelValue',e.target.value)">{{props.modelValue}}</textarea>
    </div>
</template>
