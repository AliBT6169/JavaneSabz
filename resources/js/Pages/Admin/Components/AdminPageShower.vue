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
    <div class="text-xl w-full m-auto *:text-center *:py-0.5">
        <div class="border-b-4 border-x-4 border-adminColor2 px-6 rounded-full shadow-lg shadow-gray-600">{{ PageName }}</div>
        <div v-if="PageCount!==undefined" class=" w-fit m-auto px-5 rounded-full shadow-lg shadow-gray-600 border-b-4 border-x-4 border-adminColor2">
            <span class="">صفحه {{ PageCount.currentPage }}</span> از <span class="">{{ PageCount.from }}</span>
        </div>
    </div>
</template>
