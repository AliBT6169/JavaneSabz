<script setup>
const props = defineProps({
    PageName: {
        type: String,
        required: true
    },
    PageCount: {
        type: Object,
    }
});
</script>

<template>
    <div class="pb-2 w-fit m-auto *:text-center *:py-0.5">
        <div class="border-b-4 border-t-4 border-adminColor2 px-6 rounded-lg">{{ PageName }}</div>
        <div v-if="PageCount!==undefined" class=" rounded-xl border-b-4 border-t-4 border-adminColor2">
            <span class="">صفحه {{ PageCount.currentPage }}</span> از <span class="">{{ PageCount.from }}</span>
        </div>
    </div>
</template>
