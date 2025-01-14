<script setup>
defineProps(['name', 'color', 'title']);
</script>

<template>
    <svg class="icon" :style="{fill:color}">
        <use :href="`#${name}`"></use>
        <title>{{ title }}</title>
    </svg>
</template>
