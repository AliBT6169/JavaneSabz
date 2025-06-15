<script setup>

const props = defineProps({
    modelValue: {
        required: true,
    },
});
console.log(props.modelValue)
const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="w-full">
        <div class="text-sm px-3">وضعیت :</div>
        <div class="flex items-center gap-4 p-3 bg-adminColor1 rounded-lg border-adminColor2 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4">
            <label for="active">فعال</label>
            <input :checked="modelValue===1" @change="emit('update:modelValue',1)" type="radio" id="active"
                   name="is_active"
                   class="text-adminColor2 cursor-pointer  focus:ring-0 dark:text-adminColor3">
            <label for="de_active">غیر فعال</label>
            <input :checked="modelValue===0" @change="emit('update:modelValue',0)" type="radio" id="de_active"
                   name="is_active"
                   class="text-adminColor2 cursor-pointer focus:ring-0 dark:text-adminColor3">
        </div>
    </div>
</template>
