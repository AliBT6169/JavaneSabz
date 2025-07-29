<script setup>
const props = defineProps({
    mail: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="text-sm w-80 h-80 overflow-hidden rounded-xl border-2 border-adminColor2
            bg-adminColor1 p-2 space-y-4 dark:bg-adminColor4 md:text-base md:w-96">
        <div class="flex gap-10 justify-between items-center pb-2 border-b">
            <div class="">نام: {{ mail.name }}</div>
            <div class="">شماره: {{ mail.phone }}</div>
        </div>
        <div class="text-center">{{ mail.created_at }}</div>
        <div class="border rounded-xl p-2 dark:text-white space-y-2">
            <div class="">پیام:</div>
            <p class="text-center h-40 no-scrollbar overflow-y-scroll">{{ mail.text }}</p>
        </div>
    </div>
</template>
