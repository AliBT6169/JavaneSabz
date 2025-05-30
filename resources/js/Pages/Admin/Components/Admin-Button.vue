<script setup>
const props = defineProps({
    text: '',
    type: ''
});
const emit = defineEmits({
    clicked: null
});
</script>

<template>
    <div @click="emit('clicked',true)" class="px-8 py-2 rounded-xl border-2 bg-adminColor1" :class="{'bg-adminColor1 border-adminColor2':type==='submit',
    'bg-red-300 border-red-600':type==='cancel'}">{{ text }}
    </div>
</template>

