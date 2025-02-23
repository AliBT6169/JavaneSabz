<script setup>
const props = defineProps(["label", "value", "placeholderText", "type"]);
const emit = defineEmits(['updateValue']);
</script>

<template>
    <div class="space-y-2">
        <label class="pr-2 text-black dark:text-white">{{ label }}</label>
        <input :type="type??'text'" class="w-full bg-transparent rounded-tr-2xl rounded-bl-2xl border-defaultColor dark:border-defaultColor5
                        focus:ring-0 focus:border-defaultColor" @input="(e)=>emit('updateValue',e.target.value)"
               :value="value" name="user-name" :placeholder="placeholderText">
    </div>
</template>
