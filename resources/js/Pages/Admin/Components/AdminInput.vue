<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    name: '',
    type: 'text',
    default_value: '',
    icon: ''
});
const emit = defineEmits({
    changed: ''
})
</script>

<template>
    <div class="relative w-full">
        <div class="text-sm px-3">{{ name }} :</div>
        <input :type="type" :placeholder="name" :value="default_value" @input="emit('changed',$event.target.value)"
               class="admin_inputs">
        <svg-component v-if="icon!==''" :name="icon" class="size-5 absolute left-1 top-4 z-50 text-black"/>
    </div>
</template>
