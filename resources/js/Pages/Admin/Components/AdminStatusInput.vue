<script setup>
const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
    name: String,
});
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="space-y-0">
        <div class="">{{ name }}</div>
        <div class="admin_inputs !w-fit flex gap-5 items-center">
            <label for="status_1" class="">فعال</label>
            <input type="radio" :checked="modelValue" name="status" id="status_1"
                   @change="emit('update:modelValue',true)">
            <label for="status_0" class="">غیرفعال</label>
            <input type="radio" :checked="!modelValue" name="status" id="status_0"
                   @change="emit('update:modelValue',false)">
        </div>
    </div>
</template>
