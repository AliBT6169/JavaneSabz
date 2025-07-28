<script setup>

const props = defineProps({
    title: String,
});
</script>

<template>
    <div class="space-y-5 border-4 rounded-xl p-5 border-adminColor2 w-full overflow-x-scroll no-scrollbar">
        <div class="text-lg font-bold">{{title}}</div>
        <div class="w-fit flex gap-10 items-center">
            <slot/>
        </div>
    </div>
</template>
