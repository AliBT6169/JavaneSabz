<script setup>
const props = defineProps({
    labelText: String,
    multiLine: Boolean,
    modelValue: String,
});
const emit = defineEmits({
    'update:modelValue': null,
});

</script>

<template>
    <div class="w-full h-fit text-sm justify-between items-center text-nowrap flex gap-2
     text-white dark:text-black">
        <label class="w-full" for="name">{{ props.labelText }}</label>
        <input autocomplete="off" id="name" :value="modelValue" type="text" @change="emit('update:modelValue',$event.target.value)"
               class="text-sm rounded-xl w-full bg-slate-200 dark:bg-gray-700
                text-slate-800 dark:text-white"
               v-if="!props.multiLine">
        <textarea v-if="props.multiLine" @change="emit('update:modelValue',$event.target.value)"
                  class="text-sm rounded-xl w-full bg-slate-200 dark:bg-gray-700
                text-slate-800 dark:text-white" cols="30" rows="5">{{modelValue}}</textarea>
    </div>
</template>
