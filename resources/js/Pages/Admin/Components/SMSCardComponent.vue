<script setup lang="ts">

const props = defineProps({
    sms: {
        type: Object,
    }
});
console.log(props.sms);
</script>

<template>
    <div class="w-full border-2 rounded-xl border-adminColor2 dark:border-adminColor4 p-3">
        <p class="text-sm text-center">تاریخ: {{props.sms?.created_at}}</p>
        <p class="w-full text-center">{{props.sms?.message}}</p>
    </div>
</template>
