<script setup>
const props = defineProps({
    modelValue: {
        type: String,
    }
});
const emit = defineEmits(
    'update:modelValue',
);
</script>

<template>
    <div class="">
        <div class="text-sm">روش ارسال:</div>
        <div
            class="adminOrderEditItems bg-adminColor1 border-adminColor2 !h-14 flex justify-between gap-2 items-center *:w-full dark:bg-gray-600">
            <div class="flex justify-center items-center gap-3">
                <label for="pishtaz">پیشتاز</label>
                <input type="radio" @change="emit('update:modelValue',$event.target.value)" :checked="modelValue==='pishtaz'" id="pishtaz" value="pishtaz"
                       name="delivery_methode">
            </div>
            <div class="flex justify-center items-center gap-3">
                <label for="tipax">تیپاکس</label>
                <input type="radio" @change="emit('update:modelValue',$event.target.value)" :checked="modelValue==='tipax'" id="tipax" value="tipax"
                       name="delivery_methode">
            </div>
        </div>
    </div>
</template>
