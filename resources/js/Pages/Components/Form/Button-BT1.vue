<script setup>
const props = defineProps(["buttonText", "buttonType"]);
</script>

<template>
    <button :type="props.buttonType" class="px-4 py-2 rounded-lg bg-defaultColor5 dark:text-white dark:bg-defaultColor"
            :class="{'bg-red-500 dark:bg-red-800':props.buttonType==='reset'}">{{ props.buttonText }}
    </button>
</template>

